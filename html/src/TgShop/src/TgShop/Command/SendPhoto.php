<?php
declare(strict_types=1);

namespace TgShop\Command;

use InvalidArgumentException;
use TgShop\Command\Element\InlineKeyboardMarkup;
use TgShop\Dto\MessageEntity;

class SendPhoto extends Command implements CommandInterface
{
    protected static string $uri = 'sendPhoto';

    protected int $chatId;

    protected ?string $fileId = null;

    protected ?string $imageUrl = null;

    protected ?string $imagePath = null;

    protected ?string $caption = null;

    protected ?string $parseMode = null;

    /** @var ?MessageEntity[]  */
    protected ?array $captionEntities = null;

    protected ?bool $disableNotification = null;

    protected ?int $replyToMessageId = null;

    protected ?bool $allowSendingWithoutReply = null;

    /** @var InlineKeyboardMarkup|null  */
    protected         $replyMarkup = null;

    public function __construct(int $chatId)
    {
        $this->chatId = $chatId;
    }

    public function setAllowSendingWithoutReply(?bool $allowSendingWithoutReply): SendPhoto
    {
        $this->allowSendingWithoutReply = $allowSendingWithoutReply;

        return $this;
    }

    public function setCaption(?string $caption): SendPhoto
    {
        $this->caption = $caption;

        return $this;
    }

    public function setCaptionEntities(?array $captionEntities): SendPhoto
    {
        $this->captionEntities = $captionEntities;

        return $this;
    }

    public function setDisableNotification(?bool $disableNotification): SendPhoto
    {
        $this->disableNotification = $disableNotification;

        return $this;
    }

    public function setFileId(?string $fileId): SendPhoto
    {
        $this->fileId = $fileId;

        return $this;
    }

    public function setImagePath(?string $imagePath): SendPhoto
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function setImageUrl(?string $imageUrl): SendPhoto
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function setParseMode(?string $parseMode): SendPhoto
    {
        $this->parseMode = $parseMode;

        return $this;
    }

    public function setReplyMarkup(?InlineKeyboardMarkup $replyMarkup): SendPhoto
    {
        $this->replyMarkup = $replyMarkup;

        return $this;
    }

    public function setReplyToMessageId(?int $replyToMessageId): SendPhoto
    {
        $this->replyToMessageId = $replyToMessageId;

        return $this;
    }

    public function format(): array
    {
        if (!($this->fileId || $this->imageUrl || $this->imagePath)) {
            throw new InvalidArgumentException('Either fileId or imageUrl or imagePath property should be specified');
        }

        $isMultipart = false;

        $command = [
            'chat_id' => $this->chatId,
        ];

        if ($this->imagePath) {
            $isMultipart = true;

            $command['photo'] = fopen($this->imagePath, 'r');
        }

        if ($this->fileId) {
            $command['photo'] = $this->fileId;
        }

        if ($this->imageUrl) {
            $command['photo'] = $this->imageUrl;
        }

        if ($this->caption) {
            $command['caption'] = $this->caption;
        }

        if ($this->parseMode) {
            $command['parse_mode'] = $this->parseMode;
        }

        if ($this->captionEntities) {
            $command['caption_entities'] = $this->captionEntities;
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

        if ($isMultipart) {
            $postArray = $this->formatArrayForMultipart($command);

            $command = [
                'multipart' => array_map(fn($key, $value) => ['name'=> $key, 'contents' => $value], array_keys($postArray), $postArray),
            ];
        }

        return $command;
    }

    protected function formatArrayForMultipart(array $array) {
        $this->http_build_query_for_curl( $array, $post );

        return $post;
    }

    protected function http_build_query_for_curl( $arrays, &$new = array(), $prefix = null ) {
        if (is_object($arrays)) {
            $arrays = get_object_vars($arrays);
        }

        foreach ($arrays as $key => $value) {
            $k = isset($prefix) ? $prefix . '[' . $key . ']' : $key;
            if (is_array($value) or is_object($value)) {
                $this->http_build_query_for_curl($value, $new, $k);
            } else {
                $new[$k] = $value;
            }
        }
    }
}