<?php
declare(strict_types=1);

namespace App\Processor\Handler;

use Psr\Log\LoggerInterface;
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
        $this->logger->error('Start command handler', ['request' => $request]);
    }
}