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
use Micro\Framework\Kernel\KernelInterface;
use Micro\Plugin\Doctrine\Business\Locator\EntityFileConfigurationLocatorFactoryInterface;
use Micro\Plugin\Doctrine\DoctrinePluginConfigurationInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
readonly class DriverMetadataFactory implements DriverMetadataFactoryInterface
{
    public function __construct(
        private KernelInterface $kernel,
        private EntityFileConfigurationLocatorFactoryInterface $entityFileConfigurationLocatorFactory,
        private DoctrinePluginConfigurationInterface $pluginConfiguration
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

    /**
     * @return string[]
     */
    protected function getPluginPaths(): array
    {
        $it = $this->kernel->plugins();
        $dirColl = [];
        foreach ($it as $plugin) {
            $dir = $this->getPluginDir($plugin);
            if (!$dir) {
                continue;
            }

            $dirColl[] = $dir;
        }

        return $dirColl;
    }

    protected function getPluginDir(object $plugin): string|null
    {
        $ref = new \ReflectionObject($plugin);
        $filename = $ref->getFileName();

        return $filename ? \dirname($filename) : null;
    }
}
