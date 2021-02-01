<?php

declare(strict_types=1);

namespace TgShop\Command;

class GetFile extends Command implements CommandInterface
{
    protected static string $uri = 'getFile';

    private string $fileId;

    public function __construct(string $fileId)
    {
        $this->fileId = $fileId;
    }

    public function format(): array
    {
        return [
            'file_id' => $this->fileId,
        ];
    }
}