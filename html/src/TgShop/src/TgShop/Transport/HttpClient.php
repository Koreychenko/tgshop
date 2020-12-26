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
        if (!array_key_exists('multipart', $data)) {
            $data = [
                'json' => $data,
            ];
        }

        $this->client->post($uri, $data);
    }
}