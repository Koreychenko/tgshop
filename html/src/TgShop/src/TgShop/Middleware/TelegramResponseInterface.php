<?php
declare(strict_types=1);

namespace TgShop\Middleware;

use TgShop\Command\Command;
use TgShop\Model\CommandCollection;
use TgShop\Model\CommandCollectionItem;

interface TelegramResponseInterface
{
    public function addDefaultBotCommand(Command $command): void;

    public function addCommand(CommandCollectionItem $command): void;

    public function getCommands(): CommandCollection;

    public function clearCommands(): void;
}