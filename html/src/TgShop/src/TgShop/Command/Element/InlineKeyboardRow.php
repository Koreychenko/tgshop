<?php
declare(strict_types=1);

namespace TgShop\Command\Element;

class InlineKeyboardRow
{
    /** @var InlineKeyboardButton[] */
    private array $inlineKeyboardButtons = [];

    public function addButton(InlineKeyboardButton $inlineKeyboardButton): self
    {
        $this->inlineKeyboardButtons[] = $inlineKeyboardButton;

        return $this;
    }

    public function format(): array
    {
        return array_map(fn($button) => $button->format(), $this->inlineKeyboardButtons);
    }
}