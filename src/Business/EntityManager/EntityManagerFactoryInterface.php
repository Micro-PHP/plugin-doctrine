<?php

namespace Micro\Plugin\Doctrine\Business\EntityManager;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Micro\Plugin\Doctrine\DoctrinePluginConfigurationInterface;

interface EntityManagerFactoryInterface
{
    /**
     * @param string $entityManagerName
     *
     * @return EntityManagerInterface
     *
     * @throws ORMException
     */
    public function create(string $entityManagerName): EntityManagerInterface;
}
