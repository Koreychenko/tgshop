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

    public function getCommandRoutes(string $commandName): ?array
    {
        $commands = $this->getCommands();

        foreach ($commands as $command => $routes) {
            if ($command === $commandName) {
                return $routes;
            }
        }

        return null;
    }

    public function getCommands(): ?array
    {
        if (array_key_exists(Router::SECTION_COMMANDS, $this->routes)) {
            return $this->routes[Router::SECTION_COMMANDS];
        }

        return null;
    }

    public function getQueries(): ?array
    {
        if (array_key_exists(Router::SECTION_QUERIES, $this->routes)) {
            return $this->routes[Router::SECTION_QUERIES];
        }

        return null;
    }

    public function getQueryRoutes(string $queryPath): ?array
    {
        $queries = $this->getQueries();

        foreach ($queries as $path => $routes) {
            if ($path === $queryPath) {
                return $routes;
            }
        }

        return null;
    }

    public function getStringRoutes(string $stringName): ?array
    {
        $strings = $this->getStrings();

        foreach ($strings as $string => $routes) {
            if ($string === $stringName) {
                return $routes;
            }
        }

        return null;
    }

    public function getStrings(): ?array
    {
        if (array_key_exists(Router::SECTION_STRINGS, $this->routes)) {
            return $this->routes[Router::SECTION_STRINGS];
        }

        return null;
    }
}