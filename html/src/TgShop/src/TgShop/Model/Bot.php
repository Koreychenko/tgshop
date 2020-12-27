<?php
declare(strict_types=1);

namespace TgShop\Model;

class Bot
{
    private string $id;

    private string $token;

    public function __construct(string $id, string $token)
    {
        $this->id    = $id;
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getId(): string
    {
        return $this->id;
    }
}