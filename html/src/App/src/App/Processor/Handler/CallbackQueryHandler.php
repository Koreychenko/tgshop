<?php
declare(strict_types=1);

namespace App\Processor\Handler;

use TgShop\Command\SendMessage;
use TgShop\Http\HandlerInterface;
use TgShop\Http\TelegramRequestInterface;

class CallbackQueryHandler implements HandlerInterface
{
    public function handle(TelegramRequestInterface $request)
    {
        $userId = $request->getUpdate()->getCallbackQuery()->getFrom()->getId();

        return new SendMessage($userId,
                               sprintf('CallbackQuery %s %s', $request->getParameter('param1'), $request->getParameter('param2'))
        );
    }
}