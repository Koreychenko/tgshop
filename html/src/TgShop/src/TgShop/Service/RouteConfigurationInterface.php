<?php
declare(strict_types=1);

namespace TgShop\Service;

interface RouteConfigurationInterface
{
    public function getCommandRoutes(string $commandName): ?array;

    public function getCommands(): ?array;

    public function getQueries(): ?array;

    public function getQueryRoutes(string $queryPath): ?array;

    public function getStringRoutes(string $stringName): ?array;

    public function getStrings(): ?array;
}