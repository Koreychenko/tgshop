<?php
declare(strict_types=1);

namespace TgShop\Transport;

use GuzzleHttp\Client;
use Psr\Container\ContainerInterface;

final class HttpClientFactory
{
    public function __invoke(ContainerInterface $container): HttpClient
    {
        $client = new Client(
            [
                'base_uri' => 'https://api.telegram.org',
                'timeout'  => 2.0,
            ]
        );

        return new HttpClient($client);
    }
}