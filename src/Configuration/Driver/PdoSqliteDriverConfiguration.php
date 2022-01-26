<?php

namespace Micro\Plugin\Doctrine\Configuration\Driver;

use Micro\Framework\Kernel\Configuration\PluginRoutingKeyConfiguration;


class PdoSqliteDriverConfiguration extends PluginRoutingKeyConfiguration implements DriverConfigurationInterface
{

    use UserPasswordTrait;

    const CFG_PATH = 'ORM_%s_PATH';
    const CFG_IN_MEMORY = 'ORM_%s_IN_MEMORY';

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->get(self::CFG_PATH);
    }

    /**
     * True if the SQLite database should be in-memory (non-persistent). Mutually exclusive with path. path takes precedence.
     *
     * @return bool
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
            'driver'    => 'pdo_sqlite',
            'path'      => $this->getPath(),
            'user'      => $this->getUser(),
            'password'  => $this->getPassword(),
            'memory'    => $this->inMemory(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function supports(string $driverName): bool
    {
        return 'pdo_sqlite' === $driverName;
    }
}
