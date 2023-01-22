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

namespace Micro\Plugin\Doctrine\Configuration;

use Doctrine\DBAL\DriverManager;
use Micro\Framework\Kernel\Configuration\PluginRoutingKeyConfiguration;
use Micro\Plugin\Doctrine\Configuration\Driver\DriverConfigurationInterface;
use Micro\Plugin\Doctrine\Configuration\Driver\PdoMySqlConfiguration;
use Micro\Plugin\Doctrine\Configuration\Driver\PdoSqliteDriverConfiguration;

class EntityManagerConfiguration extends PluginRoutingKeyConfiguration implements EntityManagerConfigurationInterface
{
    /**
     * Driver name.
     *
     * Example `ORM_DEFAULT_DRIVER=pdo_mysql`
     *
     * @api
     */
    public const CFG_DRIVER_NAME = 'ORM_%s_DRIVER';

    /**
     * Driver name.
     *
     * Example `ORM_DEFAULT_PROXY_DIR=${BASE_PATH}/var/cache/orm/proxy`
     *
     * @api
     */
    public const CFG_PROXY_DIR = 'ORM_%s_PROXY_DIR';

    /**
     * Driver name.
     *
     * Example `ORM_DEFAULT_CONFIG_DIR=${BASE_PATH}/var/cache/orm/proxy`
     *
     * @api
     */
    public const CFG_CONFIG_DIR = 'ORM_%s_CONFIG_DIR';

    /**
     * Driver name.
     *
     * Example `ORM_DEFAULT_METADATA_DRIVER=attribute`
     *
     * @api
     */
    public const CFG_METADATA_DRIVER = 'ORM_%s_METADATA_DRIVER';

    /**
     * Proxy dir default.
     *
     * @api
     */
    public const PROXY_DIR_DEFAULT = '/tmp/doctrine/';

    /**
     * Metadata driver default.
     *
     * @api
     */
    public const METADATA_DRIVER_DEFAULT = 'attribute';

    public function getProxyDir(): ?string
    {
        return $this->get(self::CFG_PROXY_DIR, self::PROXY_DIR_DEFAULT);
    }

    public function getDriverName(): string
    {
        return $this->get(self::CFG_DRIVER_NAME, '');
    }

    public function getDriverConfiguration(): DriverConfigurationInterface
    {
        $driverName = mb_strtolower($this->getDriverName());
        if (!\in_array($driverName, $this->getAvailableDrivers())) {
            throw new \InvalidArgumentException(sprintf('ORM: Driver `%s` is not supported.', $driverName));
        }

        /*
         *
         Implemented:
            'pdo_mysql'
            'pdo_sqlite'

         TODO:
            'pdo_pgsql'
            'pdo_oci'
            'oci8'
            'ibm_db2'
            'pdo_sqlsrv'
            'mysqli'
            'sqlsrv'
            'sqlite3'
         */
        $config = match ($driverName) {
            'pdo_mysql' => new PdoMySqlConfiguration($this->configuration, $driverName),
            'pdo_sqlite' => new PdoSqliteDriverConfiguration($this->configuration, $driverName),
        };

        if (null === $config) {
            throw new \InvalidArgumentException(sprintf('Driver `%s` is not supported now.', $driverName));
        }

        return $config;
    }

    /**
     * @return string[]
     */
    public function getAvailableDrivers(): array
    {
        return DriverManager::getAvailableDrivers();
    }

    public function getEntityConfigurationDir(): string
    {
        return $this->get(self::CFG_CONFIG_DIR);
    }
}
