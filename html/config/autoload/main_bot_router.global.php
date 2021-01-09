<?php
declare(strict_types=1);

use TgShop\Middleware\CancelWorkflowMiddleware;
use TgShop\Router\Matcher\CommandMatcher;
use TgShop\Router\Matcher\InlineQueryMatcher;
use TgShop\Router\Matcher\StringMatcher;

return [
    'telegram' => [
        'main_bot' => [
            'router' => [
                StringMatcher::SECTION => [
                    'Settings' => [
                        \App\Bot\MainBot\Middleware\String\SettingsMiddleware::class,
                    ],
                    'Add store' => [
                        \App\Bot\MainBot\Workflow\AddStore\AddStoreWorkflowFactory::SERVICE_NAME,
                    ],
                    'Stores' => [
                        \App\Bot\MainBot\Middleware\String\StoresMiddleware::class,
                    ]
                ],
                CommandMatcher::SECTION => [
                    'start' => [
                        CancelWorkflowMiddleware::class,
                        \App\Bot\MainBot\Middleware\Command\StartCommand::class,
                        \App\Bot\MainBot\Middleware\MainKeyboardMiddleware::class,
                    ],
                    'cancel' => [
                        CancelWorkflowMiddleware::class,
                    ]
                ],
                InlineQueryMatcher::SECTION => [
                    'settings' => [
                        \App\Bot\MainBot\Middleware\CallbackQuery\SettingsMenuMiddleware::class,
                    ],
                    'switch_language' => [
                        \App\Bot\MainBot\Middleware\CallbackQuery\SwitchLanguageMiddleware::class,
                    ],
                    'store_delete' => [
                        \App\Bot\MainBot\Middleware\CallbackQuery\DeleteStoreMiddleware::class,
                    ]
                ]
            ],
        ],
    ],
];
