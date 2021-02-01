<?php
declare(strict_types=1);

namespace TgShop\Transport;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function send(string $uri, array $data): ResponseInterface
    {
        if (!array_key_exists('multipart', $data)) {
            $data = [
                'json' => $data,
            ];
        }

        return $this->client->post($uri, $data);
    }

    public function download(string $uri, string $fileName): void
    {
        $resource = fopen($fileName, 'w');

        $this->client->request('GET', $uri, ['sink' => $resource]);
    }
}