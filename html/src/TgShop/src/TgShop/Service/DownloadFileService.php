<?php

declare(strict_types=1);

namespace TgShop\Service;

use Psr\Log\LoggerInterface;
use RuntimeException;
use TgShop\Model\Bot;
use TgShop\Transport\HttpClient;

class DownloadFileService
{
    protected HttpClient $httpClient;

    protected LoggerInterface $logger;

    public function __construct(HttpClient $httpClient, LoggerInterface $logger)
    {
        $this->httpClient = $httpClient;
        $this->logger     = $logger;
    }

    public function download(string $fileId, Bot $bot): string
    {
        $response = $this->httpClient->send('/bot' . $bot->getToken() . '/getFile', ['file_id' => $fileId]);

        $fileData = json_decode($response->getBody()->getContents(), true);

        $this->logger->debug('File info', ['file_info' => $fileData]);

        if (!array_key_exists('result', $fileData)) {
            throw new RuntimeException('Invalid server response on getting file info');
        }

        $filePath = $fileData['result']['file_path'];

        $tmpName = tempnam("/tmp", "FOO");

        $this->httpClient->download('/file/bot' . $bot->getToken() . '/' . $filePath, $tmpName);

        return $tmpName;
    }
}