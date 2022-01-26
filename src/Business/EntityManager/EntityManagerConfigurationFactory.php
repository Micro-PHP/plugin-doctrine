<?php

namespace Micro\Plugin\Doctrine\Business\EntityManager;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\Tools\Setup;
use Micro\Kernel\App\AppKernelInterface;
use Micro\Plugin\Doctrine\Configuration\EntityManagerConfigurationInterface;
use Micro\Plugin\Doctrine\Configuration\Locator\AnnotationEntityFileConfigurationLocator;
use Micro\Plugin\Doctrine\Configuration\Locator\AttributeEntityFileConfigurationLocator;
use Micro\Plugin\Doctrine\DoctrinePluginConfigurationInterface;

class EntityManagerConfigurationFactory implements EntityManagerConfigurationFactoryInterface
{
    /**
     * @param AppKernelInterface $kernel
     * @param DoctrinePluginConfigurationInterface $pluginConfiguration
     */
    public function __construct(
        private AppKernelInterface $kernel,
        private DoctrinePluginConfigurationInterface $pluginConfiguration
    ) {}

    /**
     * {@inheritDoc}
     */
    public function create(string $managerName): Configuration
    {
        $managerConfig = $this->pluginConfiguration->getManagerConfiguration($managerName);
        $metadataDriverAlias = $managerConfig->getMetadataDriver();

        switch ($metadataDriverAlias) {
            case EntityManagerConfigurationInterface::DRIVER_ANNOTATION:
                return $this->createAnnotationMetadataConfiguration($managerConfig);
            case EntityManagerConfigurationInterface::DRIVER_ATTRIBUTE:
                return $this->createAttributeMetadataConfiguration($managerConfig);
        }

        throw new \RuntimeException(sprintf('ORM: Driver "%s" is not supported', $metadataDriverAlias));
    }

    /**
     * @param EntityManagerConfigurationInterface $configuration
     * @return Configuration
     */
    protected function createAttributeMetadataConfiguration(EntityManagerConfigurationInterface $configuration): Configuration {
        $fileConfigurator = new AttributeEntityFileConfigurationLocator();

        return Setup::createAttributeMetadataConfiguration(
            $fileConfigurator->getFiles($this->kernel->plugins()),
            $this->kernel->isDevMode(),
            $configuration->getProxyDir()
        );
    }

    /**
     * @param EntityManagerConfigurationInterface $configuration
     * @return Configuration
     */
    protected function createAnnotationMetadataConfiguration(EntityManagerConfigurationInterface $configuration): Configuration
    {
        $fileConfigurator = new AnnotationEntityFileConfigurationLocator();

        return Setup::createAnnotationMetadataConfiguration(
            $fileConfigurator->getFiles($this->kernel->plugins()),
            $this->kernel->isDevMode(),
            $configuration->getProxyDir()
        );
    }
}
