<?php
declare(strict_types=1);

namespace TgShop\Dto;

class MessageEntity
{
    public const TYPE_MENTION       = 'mention';
    public const TYPE_HASHTAG       = 'hashtag';
    public const TYPE_CASHTAG       = 'cashtag';
    public const TYPE_BOT_COMMAND   = 'bot_command';
    public const TYPE_URL           = 'url';
    public const TYPE_EMAIL         = 'email';
    public const TYPE_PHONE_NUMBER  = 'phone_number';
    public const TYPE_BOLD          = 'bold';
    public const TYPE_ITALIC        = 'italic';
    public const TYPE_UNDERLINE     = 'underline';
    public const TYPE_STRIKETHROUGH = 'strikestrough';
    public const TYPE_CODE          = 'code';
    public const TYPE_PRE           = 'pre';
    public const TYPE_TEXT_LINK     = 'text_link';
    public const TYPE_TEXT_MENTION  = 'text_mention';

    protected string  $type;

    protected int     $offset;

    protected int     $length;

    protected ?string $url      = null;

    protected ?User   $user     = null;

    protected ?string $language = null;

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    public function setLanguage(?string $language): void
    {
        $this->language = $language;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function __construct(string $type, int $offset, int $length)
    {
        $this->type   = $type;
        $this->offset = $offset;
        $this->length = $length;
    }

    public static function createFromArray(array $array)
    {
        $entity = new static(
            $array['type'],
            $array['offset'],
            $array['length']
        );

        if (array_key_exists('url', $array)) {
            $entity->setUrl($array['url']);
        }

        if (array_key_exists('user', $array)) {
            $entity->setUser(User::createFromArray($array['user']));
        }

        if (array_key_exists('language', $array)) {
            $entity->setLanguage($array['language']);
        }

        return $entity;
    }
}