<?php
declare(strict_types=1);

use App\Processor\Handler\CallbackQueryHandler;
use App\Processor\Handler\HelloStringHandler;
use App\Processor\Handler\StartCommandHandler;
use TgShop\Service\Router;

return [
    'telegram' => [
        'main_bot' => [
            'router' => [
                Router::SECTION_STRINGS => [
                    'Hello' => [
                        HelloStringHandler::class,
                    ],
                ],
                Router::SECTION_COMMANDS => [
                    'start' => [
                        StartCommandHandler::class,
                    ],
                ],
                Router::SECTION_QUERIES => [
                    'callback_data' => [
                        CallbackQueryHandler::class,
                    ]
                ]
            ],
        ],
    ],
];
