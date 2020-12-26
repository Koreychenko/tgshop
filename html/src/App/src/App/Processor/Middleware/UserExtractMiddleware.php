<?php
declare(strict_types=1);

namespace App\Processor\Middleware;

use Psr\Log\LoggerInterface;
use TgShop\Http\MiddlewareInterface;
use TgShop\Http\TelegramRequestInterface;
use TgShop\Model\User;

class UserExtractMiddleware implements MiddlewareInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function process(TelegramRequestInterface &$request)
    {
        $user = $request->getUpdate()->getMessage()->getFrom();

        $request->setArgument(User::class, User::createFromTelegramUser($user));
    }
}