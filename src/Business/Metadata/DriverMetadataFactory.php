<?php

declare(strict_types=1);

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\Doctrine\Business\Metadata;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\ORMSetup;
use Micro\Plugin\Cache\Facade\CacheFacadeInterface;
use Micro\Plugin\Doctrine\Business\Locator\EntityFileConfigurationLocatorFactoryInterface;
use Micro\Plugin\Doctrine\Configuration\EntityManagerConfigurationInterface;
use Micro\Plugin\Doctrine\DoctrinePluginConfigurationInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
readonly class DriverMetadataFactory implements DriverMetadataFactoryInterface
{
    public function __construct(
        private EntityFileConfigurationLocatorFactoryInterface $entityFileConfigurationLocatorFactory,
        private DoctrinePluginConfigurationInterface $pluginConfiguration,
        private ?CacheFacadeInterface $cacheFacade
    ) {
    }

    public function create(string $entityManagerName): Configuration
    {
        $paths = $this->entityFileConfigurationLocatorFactory->create()->getEnabledPluginDirs();
        $emCfg = $this->pluginConfiguration->getManagerConfiguration($entityManagerName);
        $proxyDir = $emCfg->getProxyDir();

        return ORMSetup::createAttributeMetadataConfiguration(
            $paths,
            $this->pluginConfiguration->isDevMode(),
            $proxyDir
        );
    }

    private function createCacheItem(EntityManagerConfigurationInterface $configuration): CacheItemPoolInterface
    {
        $cacheItemPoolName = $configuration->getCacheItemPoolName();
        if(!$cacheItemPoolName) {
            return new ArrayAdapter();
        }

        if ($this->cacheFacade === null && $cacheItemPoolName) {
            throw new \RuntimeException(sprintf(
                'Cache pool "%s" is configured for entity manager, but cache plugin is not enabled. Please, install `composer require micro/plugin-cache`',
                $cacheItemPoolName
            ));
        }



        return $this->cacheFacade->getCachePsr16($configuration->getCacheItemPoolName());
    }
}
