<?php
declare(strict_types=1);

namespace TgShop\Command\Element;

class ReplyKeyboardMarkup
{
    /** @var ReplyKeyboardRow[] */
    private array $replyKeyboardRows = [];

    private ?bool $resizeKeyboard    = null;

    private ?bool $oneTimeKeyboard   = null;

    private ?bool $selective         = null;

    public function addRow(ReplyKeyboardRow $replyKeyboardRow): self
    {
        $this->replyKeyboardRows[] = $replyKeyboardRow;

        return $this;
    }

    public function format(): array
    {
        $markup = array_map(fn($row) => $row->format(), $this->replyKeyboardRows);

        $element = [
            'keyboard' => $markup
        ];

        if ($this->resizeKeyboard) {
            $element['resize_keyboard'] = $this->resizeKeyboard;
        }

        if ($this->oneTimeKeyboard) {
            $element['one_time_keyboard'] = $this->oneTimeKeyboard;
        }

        if ($this->selective) {
            $element['selective'] = $this->selective;
        }

        return $element;
    }

    public function setOneTimeKeyboard(bool $oneTimeKeyboard): ReplyKeyboardMarkup
    {
        $this->oneTimeKeyboard = $oneTimeKeyboard;

        return $this;
    }

    public function setResizeKeyboard(bool $resizeKeyboard): ReplyKeyboardMarkup
    {
        $this->resizeKeyboard = $resizeKeyboard;

        return $this;
    }

    public function setSelective(bool $selective): ReplyKeyboardMarkup
    {
        $this->selective = $selective;

        return $this;
    }
}