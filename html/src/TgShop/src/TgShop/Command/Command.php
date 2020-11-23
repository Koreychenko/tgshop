<?php
declare(strict_types=1);

namespace TgShop\Command;

class Command
{
    protected static string $uri = '';

    public function getUri(): string
    {
        return static::$uri;
    }
}