<?php

namespace Micro\Plugin\Doctrine\Configuration\Driver;

use Micro\Framework\Kernel\Configuration\PluginRoutingKeyConfiguration;

class PdoMySqlConfiguration extends PluginRoutingKeyConfiguration implements DriverConfigurationInterface
{
    use UserPasswordTrait;
    use HostPortDbTrait;

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return [
            'driver'    => 'pdo_mysql',
            'user'      => $this->getUser(),
            'host'      => $this->getHost(),
            'password'  => $this->getPassword(),
            'port'      => $this->getPort() ?? 3306,
            'dbname'    => $this->getDb(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function supports(string $driverName): bool
    {
        return 'pdo_mysql' === $driverName;
    }
}
