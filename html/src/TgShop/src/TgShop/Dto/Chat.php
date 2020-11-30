<?php
declare(strict_types=1);

namespace TgShop\Dto;

class Chat
{
    protected int     $id;

    protected string  $type;

    protected ?string $firstName = null;

    protected ?string $lastName  = null;

    protected ?string $username  = null;

    protected function __construct(int $id, string $type)
    {
        $this->id   = $id;
        $this->type = $type;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public static function createFromArray($array)
    {
        $chat = new static(
            $array['id'],
            $array['type']
        );

        if (array_key_exists('first_name', $array)) {
            $chat->setFirstName($array['first_name']);
        }

        if (array_key_exists('last_name', $array)) {
            $chat->setLastName($array['last_name']);
        }

        if (array_key_exists('username', $array)) {
            $chat->setUsername($array['username']);
        }

        return $chat;
    }
}