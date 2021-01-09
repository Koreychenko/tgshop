<?php
declare(strict_types=1);

use App\Bot\Common\Middleware\PersistMiddleware;
use App\Bot\Common\Middleware\UserSaveMiddleware;
use App\Bot\MainBot\Middleware\RouterMiddlewareFactory;
use TgShop\Middleware\ChatExtractorMiddleware;
use TgShop\Middleware\ErrorHandlerMiddleware;
use TgShop\Middleware\HandlerMiddleware;
use TgShop\Middleware\StateExtractorMiddleware;
use TgShop\Middleware\UserExtractorMiddleware;

return [
    'telegram' => [
        'main_bot' => [
            'pipeline' => [
                UserExtractorMiddleware::class,
                UserSaveMiddleware::class,
                ChatExtractorMiddleware::class,
                StateExtractorMiddleware::class,
                RouterMiddlewareFactory::SERVICE_NAME,
                HandlerMiddleware::class,
                PersistMiddleware::class,
                ErrorHandlerMiddleware::class,
            ],
        ],
    ],
];