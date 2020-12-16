<?php
declare(strict_types=1);

namespace TgShop\Service;

use Psr\Log\LoggerInterface;
use TgShop\Command\Command;
use TgShop\Dto\MessageEntity;
use TgShop\Dto\Update;
use TgShop\Http\HandlerInterface;
use TgShop\Http\MiddlewareInterface;
use TgShop\Http\Request;
use TgShop\Model\User;

class Router
{
    public const SECTION_COMMANDS = 'commands';
    public const SECTION_STRINGS = 'strings';
    public const SECTION_QUERIES = 'queries';

    protected RouteConfigurationInterface $routeConfiguration;

    protected LoggerInterface $logger;

    public function __construct(RouteConfigurationInterface $routeConfiguration, LoggerInterface $logger)
    {
        $this->routeConfiguration = $routeConfiguration;
        $this->logger = $logger;
    }

    public function handle(Update $update)
    {
        $routes = $this->getRouteForCommand($update);
        $request = new Request($update);

        if (!$routes) {
            $routes = $this->getRouteForString($update);
        }

        if (!$routes) {
            $routes = $this->getRouteForQuery($update);

            if ($routes) {
                $query = parse_url($update->getCallbackQuery()->getData(), PHP_URL_QUERY);
                if ($query) {
                    $queryParams = [];
                    parse_str($query, $queryParams);

                    if (!empty($queryParams)) {
                        $request->setParameters($queryParams);
                    }
                }
            }
        }

        if (!$routes) {
            return null;
        }

        return $this->processRequest($routes, $request);
    }

    private function getRouteForCommand(Update $update): ?array
    {
        $this->logger->error('Start finding route for command');
        if (empty($this->routeConfiguration->getCommands())) {
            $this->logger->error('No routes for commands for this bot');
            return null;
        }

        if (!$update->getMessage()) {
            $this->logger->error('No message in this update');
            return null;
        }

        if (!$update->getMessage()->getEntities()) {
            $this->logger->error('No entities in this message');
            return null;
        }

        foreach ($update->getMessage()->getEntities() as $entity) {
            if ($entity->getType() === MessageEntity::TYPE_BOT_COMMAND) {
                $command = mb_substr($update->getMessage()->getText(), $entity->getOffset() + 1, $entity->getLength() - 1);

                $this->logger->error(sprintf('Found command >>%s<<', $command));

                $routes = $this->routeConfiguration->getCommandRoutes($command);

                if ($routes) {
                    return $routes;
                }
            }
        }

        return null;
    }

    private function getRouteForString(Update $update): ?array
    {
        $this->logger->error('Start finding route for string');
        if (empty($this->routeConfiguration->getStrings())) {
            return null;
        }

        if (!$update->getMessage()) {
            return null;
        }

        $routes = $this->routeConfiguration->getStringRoutes($update->getMessage()->getText());

        if ($routes) {
            return $routes;
        }

        return null;
    }

    private function getRouteForQuery(Update $update): ?array
    {
        $this->logger->error('Start finding route for query');
        if (empty($this->routeConfiguration->getQueries())) {
            return null;
        }

        if (!$update->getCallbackQuery()) {
            return null;
        }

        $data = $update->getCallbackQuery()->getData();

        $path = parse_url($data, PHP_URL_PATH);

        $this->logger->error(sprintf('Found callback query path >>%s<<', $path));

        $routes = $this->routeConfiguration->getQueryRoutes($path);

        if ($routes) {
            return $routes;
        }

        return null;
    }

    protected function processRequest(array $routes, Request $request)
    {
        $result = null;
        foreach ($routes as $route) {
            if ($route instanceof MiddlewareInterface) {
                $result = $route->process($request);

                if ($result instanceof Command) {
                    return $result;
                }
            }

            if ($route instanceof HandlerInterface) {
                $result = $route->handle($request);
            }

            if ($result) {
                return $result;
            }
        }
    }
}