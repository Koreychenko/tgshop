<?php
declare(strict_types=1);

namespace TgShop\Transport;

use TgShop\Model\CommandCollection;

class ImmediateSender implements SenderInterface
{
    protected HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function send(CommandCollection $commandCollection): void
    {
        foreach ($commandCollection as $commandCollectionItem) {
            $bot     = $commandCollectionItem->getBot();
            $command = $commandCollectionItem->getCommand();

            $this->httpClient->send('/bot' . $bot->getToken() . '/' . $command->getUri(), $command->format());
        }
    }
}