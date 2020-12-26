<?php
declare(strict_types=1);

namespace TgShop\Transport;

use Psr\Container\ContainerInterface;

final class ImmediateSenderFactory
{
    public function __invoke(ContainerInterface $container): ImmediateSender
    {
        $httpClient = $container->get(HttpClient::class);

        return new ImmediateSender($httpClient);
    }
}