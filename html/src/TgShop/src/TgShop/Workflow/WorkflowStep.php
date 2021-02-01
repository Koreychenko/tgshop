<?php
declare(strict_types=1);

namespace TgShop\Workflow;

use TgShop\Helper\ArgumentHelper;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;

class WorkflowStep implements WorkflowStepInterface
{
    use ArgumentHelper;

    public function validate(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {
        return true;
    }

    public function beforeStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {

    }

    public function processStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {

    }

    public function afterStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse)
    {

    }
}