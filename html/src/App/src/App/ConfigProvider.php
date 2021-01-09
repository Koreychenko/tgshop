<?php
declare(strict_types=1);

namespace App;

use App\Aux\ConsoleApplicationFactory;
use App\Aux\LoggerFactory;
use App\Bot\Common\Middleware\PersistMiddleware;
use App\Bot\Common\Middleware\PersistMiddlewareFactory;
use App\Bot\Common\Middleware\UserSaveMiddleware;
use App\Bot\Common\Middleware\UserSaveMiddlewareFactory;
use App\Bot\Common\Repository\StateRepositoryFactory;
use App\Bot\MainBot\Http\Middleware\RequestSaverMiddleware;
use App\Bot\MainBot\Http\Middleware\RequestSaverMiddlewareFactory;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Application;
use TgShop\State\StateRepositoryInterface;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                EntityManagerInterface::class   => EntityManagerFactory::class,
                LoggerInterface::class          => LoggerFactory::class,
                Application::class              => ConsoleApplicationFactory::class,
                StateRepositoryInterface::class => StateRepositoryFactory::class,
                RequestSaverMiddleware::class   => RequestSaverMiddlewareFactory::class,
                UserSaveMiddleware::class       => UserSaveMiddlewareFactory::class,
                PersistMiddleware::class        => PersistMiddlewareFactory::class,
            ],
            'cli'        => [
            ],
        ];
    }
}