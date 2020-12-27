<?php
declare(strict_types=1);

namespace TgShop\Router\Matcher;

use Psr\Container\ContainerInterface;
use TgShop\BotApp;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Router\RouteConfigurationInterface;
use TgShop\State\StateRepositoryInterface;

class StateMatcher implements RouterMatcherInterface
{
    protected StateRepositoryInterface $stateRepository;

    public function __construct(StateRepositoryInterface $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    public function match(
        TelegramRequestInterface $telegramRequest,
        RouteConfigurationInterface $routeConfiguration,
        ContainerInterface $container
    ): ?array {
        $user = $telegramRequest->getUpdate()->getUser();
        $bot  = $telegramRequest->getArgument(BotApp::DEFAULT_BOT_ARGUMENT);

        $state = $this->stateRepository->getState($user, $bot);

        $stateHandler = $container->get($state->getHandler());

        $stateHandler->setStep($state->getStep());
        $stateHandler->setParameters($state->getParameters());

        return [$stateHandler];
    }
}