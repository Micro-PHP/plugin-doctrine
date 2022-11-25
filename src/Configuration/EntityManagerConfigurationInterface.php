<?php

namespace Micro\Plugin\Doctrine\Configuration;

use Micro\Plugin\Doctrine\Configuration\Driver\DriverConfigurationInterface;

interface EntityManagerConfigurationInterface
{
    public const DRIVER_ANNOTATION = 'annotation';
    public const DRIVER_ATTRIBUTE  = 'attribute';

    /**
     * @return string|null
     */
    public function getProxyDir(): ?string;

    /**
     * @return string
     */
    public function getEntityConfigurationDir(): string;

    /**
     *  Drivers:
     *   - pdo_mysql: A MySQL driver that uses the pdo_mysql PDO extension.
     *   - mysqli: A MySQL driver that uses the mysqli extension.
     *   - pdo_sqlite: An SQLite driver that uses the pdo_sqlite PDO extension.
     *   - pdo_pgsql: A PostgreSQL driver that uses the pdo_pgsql PDO extension.
     *   - pdo_oci: An Oracle driver that uses the pdo_oci PDO extension.
     *              Note that this driver caused problems in our tests.
     *              Prefer the oci8 driver if possible.
     *   - pdo_sqlsrv: A Microsoft SQL Server driver that uses pdo_sqlsrv PDO
     *   - sqlsrv: A Microsoft SQL Server driver that uses the sqlsrv PHP extension.
     *   - oci8: An Oracle driver that uses the oci8 PHP extension.
     *
     * @return string
     */
    public function getDriverName(): string;

    /**
     * @return DriverConfigurationInterface
     */
    public function getDriverConfiguration(): DriverConfigurationInterface;

    /**
     * Possible drivers:
     *  - EntityManagerConfigurationInterface::DRIVER_ANNOTATION
     *  - EntityManagerConfigurationInterface::DRIVER_ATTRIBUTE
     *
     * @return string
     */
    public function getMetadataDriver(): string;
}
