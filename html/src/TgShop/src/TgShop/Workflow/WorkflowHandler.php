<?php
declare(strict_types=1);

namespace TgShop\Workflow;

use TgShop\BotApp;
use TgShop\Middleware\StateExtractorMiddleware;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;
use TgShop\Middleware\UserExtractorMiddleware;
use TgShop\Model\Bot;
use TgShop\State\StateRepositoryInterface;
use TgShop\State\WorkflowHandlerInterface;
use Throwable;

class WorkflowHandler implements WorkflowHandlerInterface
{
    public const ARGUMENT_CURRENT_STATE = 'argument_current_state';

    private string $name;

    private StateRepositoryInterface $stateRepository;

    private WorkflowStepCollection $steps;

    public function __construct(string $name, WorkflowStepCollection $steps, StateRepositoryInterface $stateRepository)
    {
        $this->name            = $name;
        $this->steps           = $steps;
        $this->stateRepository = $stateRepository;
    }

    public function handle(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        $state = $telegramRequest->getArgument(StateExtractorMiddleware::ARGUMENT_CURRENT_STATE);

        if (!$state) {
            $firstStepName = $this->steps->getFirstStepName();

            $step = $this->steps->getStep($firstStepName);

            /** @var Bot $bot */
            $bot = $telegramRequest->getArgument(BotApp::DEFAULT_BOT_ARGUMENT);

            $state = $this->stateRepository->createState(
                $this->name,
                $firstStepName,
                $telegramRequest->getArgument(UserExtractorMiddleware::ARGUMENT_CURRENT_USER),
                $bot
            );

            $telegramRequest->setArgument(static::ARGUMENT_CURRENT_STATE, $state);

            $step->beforeStep($telegramRequest, $telegramResponse);

            $this->stateRepository->insert($state);

            return;
        }

        $currentStepName = $state->getStep();

        try {
            $step = $this->steps->getStep($currentStepName);

            $step->validate($telegramRequest, $telegramResponse);
            $step->processStep($telegramRequest, $telegramResponse);
            $step->afterStep($telegramRequest, $telegramResponse);

            $nextStepName = $this->steps->getNextStepName($currentStepName);

            if ($nextStepName) {
                $nextStep = $this->steps->getStep($nextStepName);
                $nextStep->beforeStep($telegramRequest, $telegramResponse);

                $state->setStep($nextStepName);

                $this->stateRepository->insert($state);
            } else {
                $this->stateRepository->remove($state);
            }
        } catch (Throwable $exception) {
            throw $exception;
        }
    }
}