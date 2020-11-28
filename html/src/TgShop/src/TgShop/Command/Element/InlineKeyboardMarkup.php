<?php
declare(strict_types=1);

namespace TgShop\Command\Element;

class InlineKeyboardMarkup
{
    /** @var InlineKeyboardRow[] */
    protected array $inlineKeyboardRows = [];

    public function addRow(InlineKeyboardRow $inlineKeyboardRow): self
    {
        $this->inlineKeyboardRows[] = $inlineKeyboardRow;

        return $this;
    }

    public function format(): array
    {
        $markup = array_map(fn($row) => $row->format(), $this->inlineKeyboardRows);
        print_r($markup);
        return ['inline_keyboard' => $markup];
    }
}