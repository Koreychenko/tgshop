<?php
declare(strict_types=1);

namespace App\Entity;

use DateTime;

class Store
{
    private int      $id;

    private int      $ownerId;

    private User     $owner;

    private string   $name;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    /** @var StoreToken[] */
    private $storeToken;

    public function getId(): int
    {
        return $this->id;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function getOwnerId(): int
    {
        return $this->ownerId;
    }

    public function setOwnerId(int $ownerId): void
    {
        $this->ownerId = $ownerId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getStoreToken(): array
    {
        return $this->storeToken;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function setStoreToken(array $storeToken): void
    {
        $this->storeToken = $storeToken;
    }

    public function addStoreToken(StoreToken $storeToken): void
    {
        $this->storeToken[] = $storeToken;
    }

    public function setOwner(User $owner): void
    {
        $this->owner = $owner;
    }
}