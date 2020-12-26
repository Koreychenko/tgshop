<?php
declare(strict_types=1);

namespace TgShop\Transport;

use TgShop\Model\CommandCollection;

interface SenderInterface
{
    public function send(CommandCollection $commandCollection): void;
}