<?php

namespace Micro\Plugin\Doctrine\Business\EntityManager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Micro\Plugin\Doctrine\DoctrinePluginConfigurationInterface;

class EntityManagerFactory implements EntityManagerFactoryInterface
{
    /**
     * @param DoctrinePluginConfigurationInterface $pluginConfiguration
     */
    public function __construct(
        private DoctrinePluginConfigurationInterface $pluginConfiguration,
        private EntityManagerConfigurationFactoryInterface $entityManagerConfigurationFactory
    ){}

    /**
     * {@inheritDoc}
     */
    public function create(string $entityManagerName = DoctrinePluginConfigurationInterface::CONNECTION_DEFAULT): EntityManagerInterface
    {
        $managerConfig = $this->pluginConfiguration->getManagerConfiguration($entityManagerName);
        $connectionConfig = $managerConfig->getDriverConfiguration();

        return EntityManager::create(
            $connectionConfig->getParameters(),
            $this->entityManagerConfigurationFactory->create($entityManagerName)
        );
    }
}
