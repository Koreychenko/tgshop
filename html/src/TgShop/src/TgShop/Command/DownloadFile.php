<?php

declare(strict_types=1);

namespace TgShop\Command;

class DownloadFile extends Command implements CommandInterface
{
    protected static string $uri = '';

    public function __construct($fileUri)
    {
        $this::$uri = $fileUri;
    }

    public function format(): array
    {
        return [];
    }
}