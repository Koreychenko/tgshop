<?php
declare(strict_types=1);

namespace App\Processor\Handler;

use Psr\Log\LoggerInterface;
use TgShop\Command\SendMessage;
use TgShop\Http\HandlerInterface;
use TgShop\Http\RequestInterface;

class StartCommandHandler implements HandlerInterface
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(RequestInterface $request)
    {
        $userId = $request->getUpdate()->getMessage()->getFrom()->getId();

        $this->logger->error('Start command handler', ['request' => $request]);

        return new SendMessage($userId, 'Hello, darling');
    }
}