<?php

namespace TgShop\Workflow;

use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponseInterface;

interface WorkflowStepInterface
{
    public function validate(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse);

    public function beforeStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse);

    public function processStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse);

    public function afterStep(TelegramRequestInterface $telegramRequest, TelegramResponseInterface $telegramResponse);
}