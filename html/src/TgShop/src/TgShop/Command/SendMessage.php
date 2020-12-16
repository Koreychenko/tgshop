<?php
declare(strict_types=1);

namespace TgShop\Command;

use TgShop\Command\Element\InlineKeyboardMarkup;

class SendMessage extends Command implements CommandInterface
{
    protected static string $uri = 'sendMessage';

    protected int     $chatId;

    protected string  $text;

    protected ?string $parseMode = null;

    protected ?array  $entities = null;

    protected ?bool   $disableWebPagePreview = null;

    protected ?bool   $disableNotification = null;

    protected ?int    $replyToMessageId = null;

    protected ?bool   $allowSendingWithoutReply = null;

    /** @var InlineKeyboardMarkup|null  */
    protected         $replyMarkup = null;

    public function __construct(
        int $chatId,
        string $text
    ) {
        $this->chatId = $chatId;
        $this->text   = $text;
    }

    public function setParseMode(string $parseMode): self
    {
        $this->parseMode = $parseMode;

        return $this;
    }

    public function setEntities(array $entities): self
    {
        $this->entities = $entities;

        return $this;
    }

    public function setDisableWebPagePreview(bool $disableWebPagePreview): self
    {
        $this->disableWebPagePreview = $disableWebPagePreview;

        return $this;
    }

    public function setDisableNotification(bool $disableNotification): self
    {
        $this->disableNotification = $disableNotification;

        return $this;
    }

    public function setReplyToMessageId(int $replyToMessageId): self
    {
        $this->replyToMessageId = $replyToMessageId;

        return $this;
    }

    public function setAllowSendingWithoutReply(bool $allowSendingWithoutReply): self
    {
        $this->allowSendingWithoutReply = $allowSendingWithoutReply;

        return $this;
    }

    public function setReplyMarkup($replyMarkup): self
    {
        $this->replyMarkup = $replyMarkup;

        return $this;
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