<?php
declare(strict_types=1);

namespace TgShop\Middleware;

use TgShop\Command\Command;
use TgShop\Model\Bot;
use TgShop\Model\CommandCollection;
use TgShop\Model\CommandCollectionItem;

class TelegramResponse implements TelegramResponseInterface
{
    private CommandCollection $commands;

    private Bot $defaultBot;

    public function __construct(Bot $defaultBot)
    {
        $this->defaultBot = $defaultBot;

        $this->commands = new CommandCollection();
    }

    public function addCommand(CommandCollectionItem $command): void
    {
        $this->commands->addCommand($command);
    }

    public function addDefaultBotCommand(Command $command): void
    {
        $this->commands->addCommand(new CommandCollectionItem($command, $this->defaultBot));
    }

    public function getCommands(): CommandCollection
    {
        return $this->commands;
    }

    public function clearCommands(): void
    {
        $this->commands->clear();
    }
}