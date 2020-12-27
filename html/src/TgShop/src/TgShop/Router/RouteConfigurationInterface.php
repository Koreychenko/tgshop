<?php
declare(strict_types=1);

namespace TgShop\Router;

interface RouteConfigurationInterface
{
    public function getSectionRoutes(string $sectionName, string $patternString): ?array;
}