<?php

namespace Micro\Plugin\Doctrine\Business\EntityManager;

use Doctrine\ORM\Configuration;

interface EntityManagerConfigurationFactoryInterface
{
    /**
     * @param string $managerName
     * @return Configuration
     */
    public function create(string $managerName): Configuration;
}
