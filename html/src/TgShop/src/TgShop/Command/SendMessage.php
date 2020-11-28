<?php
declare(strict_types=1);

namespace TgShop\Command;

use TgShop\Command\Element\InlineKeyboardMarkup;

class SendMessage extends Command implements CommandInterface
{
    protected static string $uri = 'sendMessage';

    protected int     $chatId;

    protected string  $text;

    protected ?string $parseMode;

    protected ?array  $entities;

    protected ?bool   $disableWebPagePreview;

    protected ?bool   $disableNotification;

    protected ?int    $replyToMessageId;

    protected ?bool   $allowSendingWithoutReply;

    /** @var InlineKeyboardMarkup|null  */
    protected         $replyMarkup;

    public function __construct(
        int $chatId,
        string $text,
        ?string $parseMode = null,
        ?array $entities = null,
        ?bool $disableWebPagePreview = null,
        ?bool $disableNotification = null,
        ?int $replyToMessageId = null,
        ?bool $allowSendingWithoutReply = null,
        $replyMarkup = null
    ) {
        $this->chatId                   = $chatId;
        $this->text                     = $text;
        $this->parseMode                = $parseMode;
        $this->entities                 = $entities;
        $this->disableWebPagePreview    = $disableWebPagePreview;
        $this->disableNotification      = $disableNotification;
        $this->replyToMessageId         = $replyToMessageId;
        $this->allowSendingWithoutReply = $allowSendingWithoutReply;
        $this->replyMarkup              = $replyMarkup;
    }

    public function format(): array
    {
        $command = [
            'chat_id' => $this->chatId,
            'text' => $this->text,
        ];

        if ($this->parseMode) {
            $command['parse_mode'] = $this->parseMode;
        }

        if ($this->entities) {
            $command['entities'] = array_map(fn($entity) => $entity->format(), $this->entities);
        }

        if ($this->disableWebPagePreview) {
            $command['disable_web_page_preview'] = $this->disableWebPagePreview;
        }

        if ($this->disableNotification) {
            $command['disable_notification'] = $this->disableNotification;
        }

        if ($this->replyToMessageId) {
            $command['reply_to_message_id'] = $this->replyToMessageId;
        }

        if ($this->allowSendingWithoutReply) {
            $command['allow_sending_without_reply'] = $this->allowSendingWithoutReply;
        }

        if ($this->replyMarkup) {
            $command['reply_markup'] = $this->replyMarkup->format();
        }

        return $command;
    }
}