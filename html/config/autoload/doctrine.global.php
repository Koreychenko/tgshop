<?php
declare(strict_types=1);

use Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;

$dbUsername = getenv('MYSQL_USER');
$dbPassword = getenv('MYSQL_PASSWORD');
$dbHost     = getenv('DATABASE_HOST');
$dbName     = getenv('MYSQL_DATABASE');

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'doctrine' => [
        'driver' => [
            'orm_default' => [
                'class' => SimplifiedXmlDriver::class,
                'cache' => 'filesystem',
                'paths' => [
                    __DIR__ . '/../../src/App/src/App/Persistence/Mapping' => 'App\Entity',
                ],
            ],
            // this is crucial for mappings detection to work otherwise `[cli] orm:info` will show no results
            'orm_chain_orm_default' => [
                'class'   => MappingDriverChain::class,
                'drivers' => [
                    'App\Entity' => 'orm_default',
                ],
            ],
        ],
        'migrations_configuration'      => [
            'orm_default'              => [
                // The service manager alias for the database
                'directory' => realpath(__DIR__ . '/../../src/App/src/App/Migrations'),
                'name'      => 'Default',
                'namespace' => 'App\Migrations',
                'table'     => 'doctrine_migrations',
                'column'    => 'version',
            ],
        ],
        'eventmanager' => [
            'orm_default' => [
                'subscribers' => [
                    //TimestampableListener::class,
                ],
            ],
        ],
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        'connection' => [
            'orm_default' => [
                'paths' => [
                    __DIR__ . '/../../src/App/src/App/Persistence/Mapping' => 'App\Entity',
                ],
                'doctrine_type_mappings' => [
                    'enum' => 'string',
                ],
                'params' => [
                    'driver'   => 'pdo_mysql',
                    'host'     => $dbHost,
                    'dbname'   => $dbName,
                    'user'     => $dbUsername,
                    'password' => $dbPassword,
                ],
            ],
        ],
    ],
];
