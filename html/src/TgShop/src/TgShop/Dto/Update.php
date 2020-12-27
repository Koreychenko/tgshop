<?php
declare(strict_types=1);

namespace TgShop\Dto;

use TgShop\Model\User;

class Update
{
    protected int            $updateId;

    protected ?Message       $message       = null;

    protected ?CallbackQuery $callbackQuery = null;

    public function getCallbackQuery(): ?CallbackQuery
    {
        return $this->callbackQuery;
    }

    public function setMessage(Message $message): void
    {
        $this->message = $message;
    }

    public function setCallbackQuery(CallbackQuery $callbackQuery): void
    {
        $this->callbackQuery = $callbackQuery;
    }

    protected function __construct(int $updateId)
    {
        $this->updateId = $updateId;
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
        $update = new static(
            $array['update_id']
        );

        if (array_key_exists('message', $array)) {
            $update->setMessage(Message::createFromArray($array['message']));
        }

        if (array_key_exists('callback_query', $array)) {
            $update->setCallbackQuery(CallbackQuery::createFromArray($array['callback_query']));
        }

        return $update;
    }

    public function getUser(): User
    {

    }
}