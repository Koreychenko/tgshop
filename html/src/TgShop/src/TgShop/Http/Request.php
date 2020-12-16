<?php
declare(strict_types=1);

namespace TgShop\Http;

use TgShop\Dto\Update;

class Request implements RequestInterface
{
    protected Update $update;

    protected ?array $parameters = null;

    protected ?array $arguments  = null;

    public function __construct(Update $update)
    {
        $this->update     = $update;
    }

    public function getArguments(): ?array
    {
        return $this->arguments;
    }

    public function getParameters(): ?array
    {
        return $this->parameters;
    }

    public function getUpdate(): Update
    {
        return $this->update;
    }

    public function setArgument(string $argumentName, $argument)
    {
        if (!$this->arguments) {
            $this->arguments = [];
        }

        $this->arguments[$argumentName] = $argument;
    }

    public function getArgument(string $argumentName)
    {
        if (!$this->arguments) {
            return null;
        }

        if (array_key_exists($argumentName, $this->arguments)) {
            return $this->arguments[$argumentName];
        }

        return null;
    }

    public function setArguments(?array $arguments): void
    {
        $this->arguments = $arguments;
    }

    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function getParameter(string $parameterName)
    {
        if (!$this->parameters) {
            return null;
        }

        if (!array_key_exists($parameterName, $this->parameters)) {
            return null;
        }

        return $this->parameters[$parameterName];
    }
}