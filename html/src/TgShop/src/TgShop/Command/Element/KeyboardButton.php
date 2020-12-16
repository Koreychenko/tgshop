<?php
declare(strict_types=1);

namespace TgShop\Command\Element;

use TgShop\Command\FormatObjectInterface;

class KeyboardButton implements FormatObjectInterface
{
    private string $text;

    private ?bool  $requestContact  = null;

    private ?bool  $requestLocation = null;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function format(): array
    {
        $element = [
            'text' => $this->text,
        ];

        if ($this->requestContact) {
            $element['request_contact'] = true;
        }

        if ($this->requestLocation) {
            $element['request_location'] = true;
        }

        return $element;
    }
}