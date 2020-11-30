<?php
declare(strict_types=1);

use App\Processor\Handler\StartCommandHandler;
use TgShop\Service\Router;

return [
    'telegram' => [
        'main_bot' => [
            'router' => [
                Router::SECTION_COMMANDS => [
                    'start' => [
                        StartCommandHandler::class,
                    ]
                ]
            ]
        ]
    ]
];
