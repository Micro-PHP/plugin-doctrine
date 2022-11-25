<?php

namespace Micro\Plugin\Doctrine;

use Doctrine\DBAL\Tools\Console\ConnectionProvider;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\EntityManagerProvider;

interface DoctrineFacadeInterface extends EntityManagerProvider, ConnectionProvider
{
    /**
     * @param string $managerAlias
     * @return EntityManagerInterface
     */
    public function getManager(string $managerAlias = DoctrinePluginConfigurationInterface::CONNECTION_DEFAULT): EntityManagerInterface;
}
