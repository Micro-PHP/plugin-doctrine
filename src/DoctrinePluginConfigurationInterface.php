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

namespace Micro\Plugin\Doctrine;

use Micro\Plugin\Doctrine\Configuration\EntityManagerConfigurationInterface;

interface DoctrinePluginConfigurationInterface
{
    public const MANAGER_DEFAULT = 'default';

    /**
     * If $isDevMode is true caching is done in memory with the ArrayAdapter. Proxy objects are recreated on every request.
     * If $isDevMode is false, set then proxy classes have to be explicitly created through the command line.
     * If third argument `$proxyDir` is not set, use the systems temporary directory.
     *
     * @return string|null
     */
    public function getProxyDir(): ?string;

    /**
     * List of compound names. They are also aliases for specific entity managers. By default, ["default"].
     *
     * @api
     *
     * @return string[]
     */
    public function getConnectionList(): array;

    /**
     * Environment variable `APP_ENV` start with 'dev'.
     *
     * @return bool
     */
    public function isDevMode(): bool;

    /**
     * @return string[]
     */
    public function getAvailableDrivers(): array;

    /**
     * @api
     *
     * @param string $connectionName Entity manager alias
     *
     * @return EntityManagerConfigurationInterface Returns entity manager configuration
     */
    public function getManagerConfiguration(string $connectionName): EntityManagerConfigurationInterface;
}
