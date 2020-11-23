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

    protected function __construct(
        int $id,
        bool $isBot,
        string $firstName,
        ?string $lastName,
        ?string $userName,
        ?string $languageCode,
        ?bool $canJoinGroups,
        ?bool $canReadAllGroupMessages,
        ?bool $supportsInlineQueries
    ) {
        $this->id                      = $id;
        $this->bot                     = $isBot;
        $this->firstName               = $firstName;
        $this->lastName                = $lastName;
        $this->userName                = $userName;
        $this->languageCode            = $languageCode;
        $this->canJoinGroups           = $canJoinGroups;
        $this->canReadAllGroupMessages = $canReadAllGroupMessages;
        $this->supportsInlineQueries   = $supportsInlineQueries;
    }

    public static function createFromArray($array)
    {
        return new static(
            $array['id'],
            $array['is_bot'],
            $array['first_name'],
            array_key_exists('last_name', $array) ? $array['last_name'] : null,
            array_key_exists('username', $array) ? $array['username'] : null,
            array_key_exists('language_code', $array) ? $array['language_code'] : null,
            array_key_exists('can_join_groups', $array) ? $array['can_join_groups'] : null,
            array_key_exists('can_read_all_group_messages', $array) ? $array['can_read_all_group_messages'] : null,
            array_key_exists('supports_inline_queries', $array) ? $array['supports_inline_queries'] : null,
        );
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