<?php
declare(strict_types=1);

namespace TgShop\Model;

class Bot
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}