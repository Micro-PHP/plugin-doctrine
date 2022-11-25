<?php

namespace Micro\Plugin\Doctrine;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Micro\Plugin\Doctrine\Business\EntityManager\ManagerProviderInterface;

class DoctrineFacade implements DoctrineFacadeInterface
{
    /**
     * @param ManagerProviderInterface $ormManager
     */
    public function __construct(private readonly ManagerProviderInterface $ormManager)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getManager(string $managerAlias = DoctrinePluginConfigurationInterface::CONNECTION_DEFAULT): EntityManagerInterface
    {
        return $this->ormManager->getManager($managerAlias);
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultManager(): EntityManagerInterface
    {
        return $this->getManager();
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultConnection(): Connection
    {
        return $this->getDefaultManager()->getConnection();
    }

    /**
     * {@inheritDoc}
     */
    public function getConnection(string $name): Connection
    {
        return $this->getManager($name)->getConnection();
    }
}
