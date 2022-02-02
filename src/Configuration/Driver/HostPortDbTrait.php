<?php

namespace Micro\Plugin\Doctrine\Configuration\Driver;

trait HostPortDbTrait
{
    protected static string $CFG_HOST = 'ORM_%s_HOST';
    protected static string $CFG_PORT = 'ORM_%s_PORT';
    protected static string $CFG_DB   = 'ORM_%s_DATABASE';

    /**
     * @return string|null
     */
    public function getHost(): ?string
    {
        return $this->get(self::$CFG_HOST);
    }

    /**
     * @return int|null
     */
    public function getPort(): ?int
    {
        return $this->get(self::$CFG_PORT);
    }

    /**
     * @return string
     */
    public function getDb(): string
    {
        return $this->get(self::$CFG_DB);
    }
}
