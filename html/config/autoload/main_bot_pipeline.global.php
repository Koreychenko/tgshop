<?php
declare(strict_types=1);

use App\Bot\Common\Middleware\UserSaveMiddleware;
use App\Bot\MainBot\Middleware\RouterMiddlewareFactory;
use TgShop\Middleware\ChatExtractorMiddleware;
use TgShop\Middleware\ErrorHandlerMiddleware;
use TgShop\Middleware\HandlerMiddleware;
use TgShop\Middleware\UserExtractorMiddleware;

return [
    'telegram' => [
        'main_bot' => [
            'pipeline' => [
                UserExtractorMiddleware::class,
                UserSaveMiddleware::class,
                ChatExtractorMiddleware::class,
                RouterMiddlewareFactory::SERVICE_NAME,
                HandlerMiddleware::class,
                ErrorHandlerMiddleware::class,
            ],
        ],
    ],
];