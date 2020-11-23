<?php
declare(strict_types=1);

namespace TgShop\Service;

use Psr\Container\ContainerInterface;
use TgShop\Transport\HttpClient;

final class BotFactory
{
    public function __invoke(ContainerInterface $container): Bot
    {
        $httpClient = $container->get(HttpClient::class);

        return new Bot($httpClient);
    }
}