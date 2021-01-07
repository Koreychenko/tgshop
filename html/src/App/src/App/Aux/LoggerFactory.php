<?php
declare(strict_types=1);

namespace App\Aux;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class LoggerFactory
{
    public function __invoke(ContainerInterface $container): LoggerInterface
    {
        $loggerConfig = $container->get('config')['logger'];

        // create a log channel
        $logger = new Logger('name');
        $handler = new StreamHandler($loggerConfig['path'], $loggerConfig['level']);

        $formatter = new LineFormatter(null, null, true, true);
        $formatter->setJsonPrettyPrint(true);

        $handler->setFormatter($formatter);
        $logger->pushHandler($handler);

        return $logger;
    }
}
