<?php

declare(strict_types=1);

namespace TgShop\Service;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use TgShop\Transport\HttpClient;

class DownloadFileServiceFactory
{
    public function __invoke(ContainerInterface $container): DownloadFileService
    {
        return new DownloadFileService(
            $container->get(HttpClient::class),
            $container->get(LoggerInterface::class),
        );
    }
}
