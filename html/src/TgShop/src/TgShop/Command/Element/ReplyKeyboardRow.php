<?php
declare(strict_types=1);

namespace TgShop\Command\Element;

use TgShop\Command\FormatObjectInterface;

class ReplyKeyboardRow implements FormatObjectInterface
{
    /** @var KeyboardButton[] */
    private array $keyboardButtons = [];

    public function addButton(KeyboardButton $keyboardButton): self
    {
        $this->keyboardButtons[] = $keyboardButton;

        return $this;
    }

    public function format(): array
    {
        return array_map(fn(KeyboardButton $keyboardButton) => $keyboardButton->format(), $this->keyboardButtons);
    }
}