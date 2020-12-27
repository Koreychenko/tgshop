<?php
declare(strict_types=1);

namespace TgShop\Router;

class RouteConfiguration implements RouteConfigurationInterface
{
    protected array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    protected function getSection(string $sectionName): ?array
    {
        if (array_key_exists($sectionName, $this->routes)) {
            return $this->routes[$sectionName];
        }

        return null;
    }

    public function getSectionRoutes(string $sectionName, string $patternString): ?array
    {
        $section = $this->getSection($sectionName);

        if (empty($section)) {
            return null;
        }

        foreach ($section as $pattern => $routes) {
            if ($pattern === $patternString) {
                return $routes;
            }
        }

        return null;
    }
}