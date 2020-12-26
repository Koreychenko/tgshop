<?php
declare(strict_types=1);

namespace App\Processor\Handler;

use TgShop\Command\SendMessage;
use TgShop\Http\HandlerInterface;
use TgShop\Http\TelegramRequestInterface;

class HelloStringHandler implements HandlerInterface
{
    public function handle(TelegramRequestInterface $request)
    {
        $userId = $request->getUpdate()->getMessage()->getFrom()->getId();

        return new SendMessage($userId, 'Echo Hello');
    }
}