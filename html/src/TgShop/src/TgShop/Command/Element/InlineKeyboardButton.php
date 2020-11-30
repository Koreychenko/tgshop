<?php
declare(strict_types=1);

namespace TgShop\Command\Element;

use InvalidArgumentException;
use RuntimeException;

class InlineKeyboardButton
{
    protected string $text;
    protected ?string $url = null;
    protected ?string $loginUrl = null;
    protected ?string $callbackData = null;
    protected ?string $switchInlineQuery = null;
    protected ?string $switchInlineQueryCurrentChat = null;
    protected ?bool $pay = null;

    public function __construct(
        string $text
    ) {
        $this->text = $text;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function setLoginUrl(string $loginUrl): self
    {
        $this->loginUrl = $loginUrl;

        return $this;
    }

    public function setCallbackData(string $callbackData): self
    {
        $this->callbackData = $callbackData;

        return $this;
    }

    public function setSwitchInlineQuery(string $switchInlineQuery): self
    {
        $this->switchInlineQuery = $switchInlineQuery;

        return $this;
    }

    public function setSwitchInlineQueryCurrentChat(string $switchInlineQueryCurrentChat): self
    {
        $this->switchInlineQueryCurrentChat = $switchInlineQueryCurrentChat;

        return $this;
    }

    public function setPay(bool $pay): self
    {
        $this->pay = $pay;

        return $this;
    }

    public function format()
    {
        $this->checkOptions();

        $element = [
            'text' => $this->text,
        ];

        if ($this->url) {
            $element['url'] = $this->url;
        }

        if ($this->loginUrl) {
            $element['login_url'] = $this->loginUrl;
        }

        if ($this->callbackData) {
            if (mb_strlen($this->callbackData) > 64) {
                throw new RuntimeException('Too long callback data line. Only 64 bytes allowed');
            }

            $element['callback_data'] = $this->callbackData;
        }

        if ($this->switchInlineQuery) {
            $element['switch_inline_query'] = $this->switchInlineQuery;
        }

        if ($this->switchInlineQueryCurrentChat) {
            $element['switch_inline_query_current_chat'] = $this->switchInlineQueryCurrentChat;
        }

        if ($this->pay) {
            $element['pay'] = $this->pay;
        }

        return $element;
    }

    private function checkOptions(): void
    {
        if (!(
            ($this->url)
            || ($this->loginUrl)
            || ($this->callbackData)
            || ($this->switchInlineQuery)
            || ($this->switchInlineQueryCurrentChat)
            || ($this->pay)
        )) {
            throw new InvalidArgumentException('You must use exactly one of the optional fields');
        }
    }
}