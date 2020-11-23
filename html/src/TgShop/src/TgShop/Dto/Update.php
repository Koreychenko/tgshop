<?php
declare(strict_types=1);

namespace TgShop\Dto;

class Update
{
    protected int $updateId;

    protected ?Message $message;

    protected function __construct(int $updateId, ?Message $message)
    {
        $this->updateId = $updateId;
        $this->message  = $message;
    }

    public function getUpdateId(): int
    {
        return $this->updateId;
    }

    public function getMessage(): ?Message
    {
        return $this->message;
    }

    public static function createFromArray($array)
    {
        return new static(
            $array['update_id'],
            array_key_exists('message', $array) ? Message::createFromArray($array['message']) : null
        );
    }
}