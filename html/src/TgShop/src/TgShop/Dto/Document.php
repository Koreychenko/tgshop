<?php

declare(strict_types=1);

namespace TgShop\Dto;

class Document
{
    private string $fileId;

    private string $fileUniqueId;

    private ?string $fileName = null;

    private ?string $mimeType = null;

    private ?int $fileSize = null;

    public function __construct(string $fileId, string $fileUniqueId)
    {
        $this->fileId       = $fileId;
        $this->fileUniqueId = $fileUniqueId;
    }

    public static function createFromArray($array)
    {
        return new static(
            $array['file_id'],
            $array['file_unique_id']
        );
    }

    public function getFileId(): string
    {
        return $this->fileId;
    }

    public function getFileUniqueId(): string
    {
        return $this->fileUniqueId;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }
}