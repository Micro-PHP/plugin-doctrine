<?php

namespace Micro\Plugin\Doctrine\Configuration;

use Micro\Framework\Kernel\Configuration\PluginRoutingKeyConfiguration;
use Micro\Plugin\Doctrine\Configuration\Driver\DriverConfigurationInterface;
use Micro\Plugin\Doctrine\Configuration\Driver\PdoMySqlConfiguration;
use Micro\Plugin\Doctrine\Configuration\Driver\PdoSqliteDriverConfiguration;

class EntityManagerConfiguration extends PluginRoutingKeyConfiguration implements EntityManagerConfigurationInterface
{

    const CFG_DRIVER_NAME = 'ORM_%s_DRIVER';
    const CFG_PROXY_DIR = 'ORM_%s_PROXY_DIR';
    const CFG_CONFIG_DIR = 'ORM_%s_CONFIG_DIR';
    const CFG_METADATA_DRIVER = 'ORM_%s_METADATA_DRIVER';

    public const PROXY_DIR_DEFAULT = '/tmp/doctrine/';
    public const METADATA_DRIVER_DEFAULT = 'attribute';

    /**
     * @return string|null
     */
    public function getProxyDir(): ?string
    {
        return $this->get(self::CFG_PROXY_DIR, self::PROXY_DIR_DEFAULT);
    }

    /**
     * {@inheritDoc}
     */
    public function getDriverName(): string
    {
        return $this->get(self::CFG_DRIVER_NAME, '');
    }

    /**
     * {@inheritDoc}
     */
    public function getMetadataDriver(): string
    {
        return $this->get(self::CFG_METADATA_DRIVER, self::METADATA_DRIVER_DEFAULT);
    }

    /**
     * {@inheritDoc}
     */
    public function getDriverConfiguration(): DriverConfigurationInterface
    {
        $driverName = $this->getDriverName();
        foreach ($this->getDriversAvailable() as $driverClass) {
            if(!$driverClass::supports($driverName)) {
                continue;
            }

            return new $driverClass($this->configuration, $this->configRoutingKey);
        }

        throw new \InvalidArgumentException(sprintf('ORM: Driver "%s" is not supported.', $driverName));
    }

    /**
     * @return string[]
     */
    protected function getDriversAvailable(): array
    {
        return [
            PdoSqliteDriverConfiguration::class,
            PdoMySqlConfiguration::class
        ];
    }

    /**
     * @return string
     */
    public function getEntityConfigurationDir(): string
    {
        return $this->get(self::CFG_CONFIG_DIR);
    }
}
