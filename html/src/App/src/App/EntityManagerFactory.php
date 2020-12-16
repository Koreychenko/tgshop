<?php
declare(strict_types=1);

namespace App;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\PhpFileCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver;

final class EntityManagerFactory
{
    public function __invoke(ContainerInterface $container): EntityManagerInterface
    {
        $dbParams  = $container->get('config')['doctrine']['connection']['orm_default']['params'];
        $paths     = $container->get('config')['doctrine']['connection']['orm_default']['paths'];
        $isDevMode = $container->get('config')['debug'];

        if ($isDevMode) {
            $cache = new ArrayCache;
        } else {
            $cache = new PhpFileCache(__DIR__ . '/../../../../data/cache');
        }

        $config = Setup::createConfiguration($isDevMode, null, $cache);
        $config->setMetadataDriverImpl(new SimplifiedXmlDriver($paths));

        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);

        $config->setAutoGenerateProxyClasses(true);
        $config->setProxyDir(__DIR__ . '/Proxies');
        $config->setProxyNamespace('App\Proxies');

        return EntityManager::create($dbParams, $config);
    }
}
