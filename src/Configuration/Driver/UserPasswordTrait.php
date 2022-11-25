<?php

namespace Micro\Plugin\Doctrine\Configuration\Driver;

trait UserPasswordTrait
{
    protected static string $CFG_IN_USER  = 'ORM_%s_USER';
    protected static string $CFG_PASSWORD = 'ORM_%s_PASSWORD';

    /**
     * @return string|null
     */
    public function getUser(): ?string
    {
        return $this->get(self::$CFG_IN_USER);
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->get(self::$CFG_PASSWORD);
    }
}
