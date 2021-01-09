<?php
declare(strict_types=1);

namespace App\Entity;

use TgShop\Dto\UserInterface;

class User implements UserInterface
{
    private ?int    $id = null;

    private int     $telegramId;

    private bool    $bot;

    private string  $firstName;

    private ?string $languageCode            = null;

    private ?string $lastName                = null;

    private ?string $userName                = null;

    private ?bool   $canJoinGroups           = null;

    private ?bool   $canReadAllGroupMessages = null;

    private ?bool   $supportsInlineQueries   = null;

    private $stores = null;

    private $states = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStores()
    {
        return $this->stores;
    }

    public function getTelegramId(): int
    {
        return $this->telegramId;
    }

    public function setTelegramId(int $telegramId): void
    {
        $this->telegramId = $telegramId;
    }

    public function isBot(): bool
    {
        return $this->bot;
    }

    public function setBot(bool $bot): void
    {
        $this->bot = $bot;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLanguageCode(): ?string
    {
        return $this->languageCode;
    }

    public function setLanguageCode(?string $languageCode): void
    {
        $this->languageCode = $languageCode;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(?string $userName): void
    {
        $this->userName = $userName;
    }

    public function getCanJoinGroups(): ?bool
    {
        return $this->canJoinGroups;
    }

    public function setCanJoinGroups(?bool $canJoinGroups): void
    {
        $this->canJoinGroups = $canJoinGroups;
    }

    public function getCanReadAllGroupMessages(): ?bool
    {
        return $this->canReadAllGroupMessages;
    }

    public function setCanReadAllGroupMessages(?bool $canReadAllGroupMessages): void
    {
        $this->canReadAllGroupMessages = $canReadAllGroupMessages;
    }

    public function getSupportsInlineQueries(): ?bool
    {
        return $this->supportsInlineQueries;
    }

    public function setSupportsInlineQueries(?bool $supportsInlineQueries): void
    {
        $this->supportsInlineQueries = $supportsInlineQueries;
    }

    public function setStores($stores): void
    {
        $this->stores = $stores;
    }
}