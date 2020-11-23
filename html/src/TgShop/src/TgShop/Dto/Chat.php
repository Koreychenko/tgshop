<?php
declare(strict_types=1);

namespace TgShop\Dto;

class Chat
{
    protected int    $id;

    protected string $type;

    protected ?string $firstName;

    protected ?string $lastName;

    protected ?string $username;

    protected function __construct(int $id, string $type, ?string $firstName, ?string $lastName, ?string $username)
    {
        $this->id        = $id;
        $this->type      = $type;
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->username  = $username;
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
        return new static(
            $array['id'],
            $array['type'],
            array_key_exists('first_name', $array) ? $array['first_name'] : null,
            array_key_exists('last_name', $array) ? $array['last_name'] : null,
            array_key_exists('username', $array) ? $array['username'] : null
        );
    }
}