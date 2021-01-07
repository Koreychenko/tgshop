<?php
declare(strict_types=1);

use TgShop\Router\Matcher\CommandMatcher;
use TgShop\Router\Matcher\InlineQueryMatcher;
use TgShop\Router\Matcher\StringMatcher;

return [
    'telegram' => [
        'main_bot' => [
            'router' => [
                StringMatcher::SECTION => [
                ],
                CommandMatcher::SECTION => [
                    'start' => [
                        \App\Bot\MainBot\Middleware\Command\StartCommand::class,
                    ]
                ],
                InlineQueryMatcher::SECTION => [
                ]
            ],
        ],
    ],
];
