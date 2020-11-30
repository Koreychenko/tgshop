<?php
declare(strict_types=1);

namespace TgShop\Dto;

use DateTime;

class Message
{
    protected int       $messageId;

    protected Chat      $chat;

    protected DateTime  $date;

    protected ?string   $text     = null;

    protected ?User     $from     = null;

    /** @var MessageEntity[] */
    protected ?array    $entities = null;

    /**
     * @return MessageEntity[]
     */
    public function getEntities(): array
    {
        return $this->entities;
    }

    /**
     * @param MessageEntity[] $entities
     */
    public function setEntities(array $entities): void
    {
        $this->entities = $entities;
    }

    public function addEntity(MessageEntity $entity): void
    {
        if (!$this->entities) {
            $this->entities = [];
        }

        $this->entities[] = $entity;
    }

    protected function __construct(int $messageId, Chat $chat, DateTime $date)
    {
        $this->messageId = $messageId;
        $this->chat      = $chat;
        $this->date      = $date;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function setFrom(User $from): void
    {
        $this->from = $from;
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
        $message = new static(
            $array['message_id'],
            Chat::createFromArray($array['chat']),
            DateTime::createFromFormat('U', (string) $array['date'])
        );

        if (array_key_exists('text', $array)) {
            $message->setText($array['text']);
        }

        if (array_key_exists('from', $array)) {
            $message->setFrom(User::createFromArray($array['from']));
        }

        if (array_key_exists('entities', $array)) {
            foreach ($array['entities'] as $entity) {
                $message->addEntity(MessageEntity::createFromArray($entity));
            }
        }

        return $message;
    }
}