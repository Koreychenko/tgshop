<?php
declare(strict_types=1);

use TgShop\Router\Matcher\CommandMatcher;
use TgShop\Router\Matcher\InlineQueryMatcher;
use TgShop\Router\Matcher\StringMatcher;

return [
    'telegram' => [
        'store_bot' => [
            'router' => [
                StringMatcher::SECTION => [
                ],
                CommandMatcher::SECTION => [
                ],
                InlineQueryMatcher::SECTION => [
                ]
            ],
        ],
    ],
];
