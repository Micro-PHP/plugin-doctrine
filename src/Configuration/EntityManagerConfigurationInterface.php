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

use Micro\Plugin\Doctrine\Configuration\Driver\DriverConfigurationInterface;

interface EntityManagerConfigurationInterface
{
    public const DRIVER_ANNOTATION = 'annotation';
    public const DRIVER_ATTRIBUTE = 'attribute';

    /**
     * @api
     */
    public function getEntityConfigurationDir(): string;

    /**
     *  Get entity manager driver.
     *
     * @api
     */
    public function getDriverName(): string;

    /**
     *          Implemented:
     * 'pdo_mysql'
     * 'pdo_sqlite'
     * 'pdo_pgsql'
     *
     * TODO:
     *      - 'pdo_oci'
     *      -  'oci8'
     *      - 'ibm_db2'
     *      - 'pdo_sqlsrv'
     *      - 'mysqli'
     *      - 'sqlsrv'
     *
     * @api
     */
    public function getDriverConfiguration(): DriverConfigurationInterface;
}
