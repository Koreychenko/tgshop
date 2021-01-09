<?php
declare(strict_types=1);

namespace TgShop\Dto;

interface UserInterface
{
    public function setLastName(string $lastName): void;

    public function setUserName(string $userName): void;

    public function setLanguageCode(string $languageCode): void;

    public function setCanJoinGroups(bool $canJoinGroups): void;

    public function setCanReadAllGroupMessages(bool $canReadAllGroupMessages): void;

    public function setSupportsInlineQueries(bool $supportsInlineQueries): void;

    public function getCanJoinGroups(): ?bool;

    public function getCanReadAllGroupMessages(): ?bool;

    public function getFirstName(): string;

    public function getId(): ?int;

    public function getLanguageCode(): ?string;

    public function getLastName(): ?string;

    public function getSupportsInlineQueries(): ?bool;

    public function getUserName(): ?string;

    public function isBot(): bool;
}