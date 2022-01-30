<?php

namespace Micro\Plugin\Doctrine;

use Micro\Framework\Kernel\Configuration\PluginConfiguration;
use Micro\Plugin\Doctrine\Configuration\EntityManagerConfiguration;
use Micro\Plugin\Doctrine\Configuration\EntityManagerConfigurationInterface;

class DoctrinePluginConfiguration extends PluginConfiguration implements DoctrinePluginConfigurationInterface
{
    const CFG_CONNECTIONS = 'ORM_CONNECTION_LIST';

    /**
     * {@inheritDoc}
     */
    public function getConnectionList(): array
    {
        return $this->explodeStringToArray(
            $this->configuration->get(self::CFG_CONNECTIONS, self::CONNECTION_DEFAULT)
        );
    }

    /**
     * @param string $connectionName
     * @return EntityManagerConfigurationInterface
     */
    public function getManagerConfiguration(string $connectionName): EntityManagerConfigurationInterface
    {
        return new EntityManagerConfiguration($this->configuration, $connectionName);
    }
}
