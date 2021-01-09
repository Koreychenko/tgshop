<?php
declare(strict_types=1);

namespace TgShop\Middleware;

use TgShop\BotApp;
use TgShop\State\StateRepositoryInterface;

class StateExtractorMiddleware implements MiddlewareInterface
{
    public const ARGUMENT_CURRENT_STATE = 'argument_current_state';

    protected StateRepositoryInterface $stateRepository;

    public function __construct(StateRepositoryInterface $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $user = $telegramRequest->getArgument(UserExtractorMiddleware::ARGUMENT_CURRENT_USER);
        $bot  = $telegramRequest->getArgument(BotApp::DEFAULT_BOT_ARGUMENT);

        $state = $this->stateRepository->getState($user, $bot);

        if ($state) {
            $telegramRequest->setArgument(static::ARGUMENT_CURRENT_STATE, $state);
        }
    }
}