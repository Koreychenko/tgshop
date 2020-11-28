<?php
declare(strict_types=1);

namespace TgShop\Command\Element;

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
        string $text,
        ?string $url = null,
        ?string $loginUrl = null,
        ?string $callbackData = null,
        ?string $switchInlineQuery = null,
        ?string $switchInlineQueryCurrentChat = null,
        ?bool $pay = null
    ) {
        $this->text                         = $text;
        $this->url                          = $url;
        $this->loginUrl                     = $loginUrl;
        $this->callbackData                 = $callbackData;
        $this->switchInlineQuery            = $switchInlineQuery;
        $this->switchInlineQueryCurrentChat = $switchInlineQueryCurrentChat;
        $this->pay                          = $pay;
    }

    public function format()
    {
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
}