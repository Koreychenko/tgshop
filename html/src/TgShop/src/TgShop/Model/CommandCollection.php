<?php
declare(strict_types=1);

namespace TgShop\Model;

use Iterator;

class CommandCollection implements Iterator
{
    /** @var CommandCollectionItem[] */
    private array $commands;

    private int   $position;

    public function __construct()
    {
        $this->commands = [];
        $this->position = 0;
    }

    public function addCommand(CommandCollectionItem $commandCollectionItem): void
    {
        $this->commands[] = $commandCollectionItem;
    }

    public function current(): CommandCollectionItem
    {
        return $this->commands[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->commands[$this->position]);
    }
}