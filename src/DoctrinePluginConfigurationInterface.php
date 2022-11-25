<?php

namespace Micro\Plugin\Doctrine;

use Micro\Plugin\Doctrine\Configuration\DriverConfigurationInterface;
use Micro\Plugin\Doctrine\Configuration\EntityManagerConfigurationInterface;

interface DoctrinePluginConfigurationInterface
{
    public const CONNECTION_DEFAULT = 'default';

    /**
     * @return array
     */
    public function getConnectionList(): array;

    /**
     * @param string $connectionName
     * @return EntityManagerConfigurationInterface
     */
    public function getManagerConfiguration(string $connectionName): EntityManagerConfigurationInterface;
}
