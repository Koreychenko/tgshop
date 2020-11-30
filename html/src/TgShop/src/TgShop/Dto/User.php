<?php
declare(strict_types=1);

namespace TgShop\Dto;

class User
{
    protected bool    $bot;

    protected string  $firstName;

    protected ?string $lastName                = null;

    protected ?string $userName                = null;

    protected ?string $languageCode            = null;

    protected ?bool   $canJoinGroups           = null;

    protected ?bool   $canReadAllGroupMessages = null;

    protected ?bool   $supportsInlineQueries   = null;

    private int       $id;

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    public function setLanguageCode(string $languageCode): void
    {
        $this->languageCode = $languageCode;
    }

    public function setCanJoinGroups(bool $canJoinGroups): void
    {
        $this->canJoinGroups = $canJoinGroups;
    }

    public function setCanReadAllGroupMessages(bool $canReadAllGroupMessages): void
    {
        $this->canReadAllGroupMessages = $canReadAllGroupMessages;
    }

    public function setSupportsInlineQueries(bool $supportsInlineQueries): void
    {
        $this->supportsInlineQueries = $supportsInlineQueries;
    }

    protected function __construct(
        int $id,
        bool $isBot,
        string $firstName
    ) {
        $this->id        = $id;
        $this->bot       = $isBot;
        $this->firstName = $firstName;
    }

    public static function createFromArray($array)
    {
        $user = new static(
            $array['id'],
            $array['is_bot'],
            $array['first_name']
        );

        if (array_key_exists('last_name', $array)) {
            $user->setLastName($array['last_name']);
        }

        if (array_key_exists('username', $array)) {
            $user->setUserName($array['username']);
        }

        if (array_key_exists('language_code', $array)) {
            $user->setLanguageCode($array['language_code']);
        }

        if (array_key_exists('can_join_groups', $array)) {
            $user->setCanJoinGroups($array['can_join_groups']);
        }

        if (array_key_exists('can_read_all_group_messages', $array)) {
            $user->setCanReadAllGroupMessages($array['can_read_all_group_messages']);
        }

        if (array_key_exists('supports_inline_queries', $array)) {
            $user->setSupportsInlineQueries($array['supports_inline_queries']);
        }

        return $user;
    }

    public function getCanJoinGroups(): ?bool
    {
        return $this->canJoinGroups;
    }

    public function getCanReadAllGroupMessages(): ?bool
    {
        return $this->canReadAllGroupMessages;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLanguageCode(): ?string
    {
        return $this->languageCode;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getSupportsInlineQueries(): ?bool
    {
        return $this->supportsInlineQueries;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function isBot(): bool
    {
        return $this->bot;
    }
}