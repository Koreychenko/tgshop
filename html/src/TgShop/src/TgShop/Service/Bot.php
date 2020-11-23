<?php
declare(strict_types=1);

namespace TgShop\Service;

use RuntimeException;
use TgShop\Command\CommandInterface;
use TgShop\Transport\HttpClient;

class Bot
{
    protected HttpClient $httpClient;

    protected ?string $token = null;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function setToken(string $token)
    {
        $this->token = $token;
    }

    public function send(CommandInterface $command): void
    {
        if (!$this->token) {
            throw new RuntimeException('Token is not set');
        }

        $this->httpClient->send('/bot' . $this->token . '/' . $command->getUri(), $command->format());
    }
}