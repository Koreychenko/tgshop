<?php
declare(strict_types=1);

namespace App\Entity;

class StoreToken
{
    private int    $id;

    private int    $storeId;

    private string $botToken;

    private string $accessToken;

    private bool $active;

    private Store  $store;

    public function getId(): int
    {
        return $this->id;
    }

    public function getStore(): Store
    {
        return $this->store;
    }

    public function getStoreId(): int
    {
        return $this->storeId;
    }

    public function setStoreId(int $storeId): void
    {
        $this->storeId = $storeId;
    }

    public function getBotToken(): string
    {
        return $this->botToken;
    }

    public function setBotToken(string $botToken): void
    {
        $this->botToken = $botToken;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    public function setStore(Store $store): void
    {
        $this->store = $store;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }
}