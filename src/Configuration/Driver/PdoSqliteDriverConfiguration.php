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

namespace Micro\Plugin\Doctrine\Configuration\Driver;

use Micro\Framework\Kernel\Configuration\PluginRoutingKeyConfiguration;

class PdoSqliteDriverConfiguration extends PluginRoutingKeyConfiguration implements DriverConfigurationInterface
{
    use UserPasswordTrait;

    public const CFG_PATH = 'ORM_%s_PATH';
    public const CFG_IN_MEMORY = 'ORM_%s_IN_MEMORY';

    public function getPath(): ?string
    {
        return $this->get(self::CFG_PATH);
    }

    /**
     * True if the SQLite database should be in-memory (non-persistent). Mutually exclusive with path. path takes precedence.
     */
    public function inMemory(): bool
    {
        return $this->get(self::CFG_IN_MEMORY, false);
    }

    /**
     * {@inheritDoc}
     */
    public function getParameters(): array
    {
        return [
            'driver' => 'pdo_sqlite',
            'path' => $this->getPath(),
            'user' => $this->getUser(),
            'password' => $this->getPassword(),
            'memory' => $this->inMemory(),
        ];
    }
}
