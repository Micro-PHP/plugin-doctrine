<?php

namespace Micro\Plugin\Doctrine\Configuration\Driver;

interface DriverConfigurationInterface
{
    /**
     * @return array
     */
    public function getParameters(): array;

    /**
     * @param string $driverName
     * @return bool
     */
    public static function supports(string $driverName): bool;
}
