<?php
declare(strict_types=1);

namespace App\Processor\Handler;

use App\Element\Keyboard;
use Psr\Log\LoggerInterface;
use TgShop\Command\SendMessage;
use TgShop\Http\HandlerInterface;
use TgShop\Http\TelegramRequestInterface;
use TgShop\Model\User;

class StartCommandHandler implements HandlerInterface
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(TelegramRequestInterface $request)
    {
        /** @var User $user */
        $user = $request->getArgument(User::class);

        return (new SendMessage($user->getTelegramId(), 'Hello, darling'))->setReplyMarkup(Keyboard::getMainKeyboard());
    }
}