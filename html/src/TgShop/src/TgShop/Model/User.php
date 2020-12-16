<?php
declare(strict_types=1);

namespace TgShop\Model;

class User
{
    private ?bool   $bot                     = false;

    private ?bool   $canJoinGroups           = null;

    private ?bool   $canReadAllGroupMessages = null;

    private ?string $firstName               = null;

    private ?int    $id                      = null;

    private ?string $languageCode            = null;

    private ?string $lastName                = null;

    private ?bool   $supportsInlineQueries   = null;

    private ?int    $telegramId              = null;

    private ?string $userName                = null;

    public function getBot(): ?bool
    {
        return $this->bot;
    }

    public function setBot(?bool $bot): void
    {
        $this->bot = $bot;
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
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

    public function getSupportsInlineQueries(): ?bool
    {
        return $this->supportsInlineQueries;
    }

    public function setSupportsInlineQueries(?bool $supportsInlineQueries): void
    {
        $this->supportsInlineQueries = $supportsInlineQueries;
    }

    public function getTelegramId(): ?int
    {
        return $this->telegramId;
    }

    public function setTelegramId(?int $telegramId): void
    {
        $this->telegramId = $telegramId;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(?string $userName): void
    {
        $this->userName = $userName;
    }

    public static function createFromTelegramUser(\TgShop\Dto\User $telegramUser): self
    {
        $user = new static();
        $user->setTelegramId($telegramUser->getId());
        $user->setLanguageCode($telegramUser->getLanguageCode());
        $user->setFirstName($telegramUser->getFirstName());

        return $user;
    }
}