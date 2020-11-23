<?php
declare(strict_types=1);

namespace TgShop\Transport;

use GuzzleHttp\Client;

class HttpClient
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function send(string $uri, array $data): void
    {
        $this->client->post($uri, [
            'json' => $data,
        ]);
    }
}