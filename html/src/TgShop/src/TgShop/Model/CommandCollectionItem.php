<?php
declare(strict_types=1);

namespace TgShop\Model;

use TgShop\Command\Command;

class CommandCollectionItem
{
    private Command $command;

    private Bot $bot;

    public function __construct(Command $command, Bot $bot)
    {
        $this->command = $command;
        $this->bot     = $bot;
    }

    public function getCommand(): Command
    {
        return $this->command;
    }

    public function getBot(): Bot
    {
        return $this->bot;
    }
}