<?php

declare(strict_types=1);

use App\Handler\ClientBotHandlerFactory;
use App\Handler\UpdateHandler;
use App\Handler\MainBotHandlerFactory;
use App\Middleware\CheckTokenMiddleware;
use App\Middleware\ExtractStoreParametersMiddleware;
use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

/**
 * laminas-router route configuration
 *
 * @see https://docs.laminas.dev/laminas-router/
 *
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 */
return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->post('/update/mainbot/:token', [
        CheckTokenMiddleware::class,
        MainBotHandlerFactory::SERVICE_NAME
    ]);

    $app->post('/update/store/:token', [
        ExtractStoreParametersMiddleware::class,
        ClientBotHandlerFactory::SERVICE_NAME
    ]);
};
