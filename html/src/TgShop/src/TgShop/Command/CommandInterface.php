<?php
declare(strict_types=1);

namespace TgShop\Command;

interface CommandInterface
{
    public function getUri(): string;
    public function format(): array;
}