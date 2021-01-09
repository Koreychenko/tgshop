<?php
declare(strict_types=1);

namespace TgShop\Router\Matcher;

use Psr\Container\ContainerInterface;
use TgShop\Middleware\StateExtractorMiddleware;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Router\RouteConfigurationInterface;
use TgShop\State\StateInterface;

class StateMatcher implements RouterMatcherInterface
{
    public function match(
        TelegramRequestInterface $telegramRequest,
        RouteConfigurationInterface $routeConfiguration,
        ContainerInterface $container
    ): ?array {
        /** @var StateInterface $state */
        $state = $telegramRequest->getArgument(StateExtractorMiddleware::ARGUMENT_CURRENT_STATE);

        if (!$state) {
            return null;
        }

        $stateHandler = $container->get($state->getWorkflow());

        return [$stateHandler];
    }
}