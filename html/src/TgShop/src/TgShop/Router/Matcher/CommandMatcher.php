<?php
declare(strict_types=1);

namespace TgShop\Router\Matcher;

use Psr\Container\ContainerInterface;
use TgShop\Dto\MessageEntity;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Router\RouteConfigurationInterface;

class CommandMatcher implements RouterMatcherInterface
{
    public const SECTION = 'command';

    public function match(
        TelegramRequestInterface $telegramRequest,
        RouteConfigurationInterface $routeConfiguration,
        ContainerInterface $container
    ): ?array {
        $update = $telegramRequest->getUpdate();

        if (empty($routeConfiguration->getCommands())) {
            return null;
        }

        if (!$update->getMessage()) {
            return null;
        }

        if (!$update->getMessage()->getEntities()) {
            return null;
        }

        foreach ($update->getMessage()->getEntities() as $entity) {
            if ($entity->getType() === MessageEntity::TYPE_BOT_COMMAND) {
                $command = mb_substr($update->getMessage()->getText(), $entity->getOffset() + 1,
                                     $entity->getLength() - 1);

                $routes = $routeConfiguration->getCommandRoutes($command);

                if ($routes) {
                    return $routes;
                }
            }
        }

        return null;
    }
}