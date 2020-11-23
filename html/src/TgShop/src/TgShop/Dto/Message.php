<?php
declare(strict_types=1);

namespace TgShop\Dto;

use DateTime;

class Message
{
    protected int       $messageId;

    protected Chat      $chat;

    protected DateTime  $date;

    protected ?string   $text;

    protected ?User     $from;

    protected function __construct(int $messageId, Chat $chat, DateTime $date, ?string $text, ?User $from)
    {
        $this->messageId = $messageId;
        $this->chat      = $chat;
        $this->date      = $date;
        $this->text      = $text;
        $this->from      = $from;
    }

    public function getMessageId(): int
    {
        return $this->messageId;
    }

    public function getChat(): Chat
    {
        return $this->chat;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function getFrom(): ?User
    {
        return $this->from;
    }

    public static function createFromArray($array)
    {
        return new static(
            $array['message_id'],
            Chat::createFromArray($array['chat']),
            DateTime::createFromFormat('U', (string) $array['date']),
            array_key_exists('text', $array) ? $array['text'] : null,
            array_key_exists('from', $array) ? User::createFromArray($array['from']) : null
        );
    }
}