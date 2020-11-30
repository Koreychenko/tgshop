<?php
declare(strict_types=1);

namespace TgShop\Dto;

class CallbackQuery
{
    private string   $id;

    private User     $from;

    private string   $data;

    private string   $chatInstance;

    private ?Message $message         = null;

    private ?string  $inlineMessageId = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function getFrom(): User
    {
        return $this->from;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function getChatInstance(): string
    {
        return $this->chatInstance;
    }

    public function getMessage(): ?Message
    {
        return $this->message;
    }

    public function getInlineMessageId(): ?string
    {
        return $this->inlineMessageId;
    }

    public function setMessage(Message $message): void
    {
        $this->message = $message;
    }

    public function setInlineMessageId(string $inlineMessageId): void
    {
        $this->inlineMessageId = $inlineMessageId;
    }

    private function __construct(string $id, User $from, string $data, string $chatInstance)
    {
        $this->id           = $id;
        $this->from         = $from;
        $this->data         = $data;
        $this->chatInstance = $chatInstance;
    }

    public static function createFromArray($array)
    {
        $callbackQuery = new static(
            $array['id'],
            User::createFromArray($array['from']),
            $array['data'],
            $array['chat_instance'],
        );

        if (array_key_exists('message', $array)) {
            $callbackQuery->setMessage(Message::createFromArray($array['message']));
        }

        if (array_key_exists('inline_message_id', $array)) {
            $callbackQuery->setInlineMessageId($array['inline_message_id']);
        }

        return $callbackQuery;
    }
}