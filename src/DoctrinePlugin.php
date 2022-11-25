<?php

namespace Micro\Plugin\Doctrine;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\KernelInterface;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Kernel\App\AppKernelInterface;
use Micro\Plugin\Doctrine\Business\EntityManager\EntityManagerConfigurationFactory;
use Micro\Plugin\Doctrine\Business\EntityManager\EntityManagerConfigurationFactoryInterface;
use Micro\Plugin\Doctrine\Business\EntityManager\EntityManagerFactory;
use Micro\Plugin\Doctrine\Business\EntityManager\EntityManagerFactoryInterface;
use Micro\Plugin\Doctrine\Business\EntityManager\ManagerProvider;
use Micro\Plugin\Doctrine\Business\EntityManager\ManagerProviderInterface;

/**
 * @method DoctrinePluginConfigurationInterface configuration()
 */
class DoctrinePlugin extends AbstractPlugin
{
    private readonly KernelInterface $kernel;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(DoctrineFacadeInterface::class, function (KernelInterface $kernel) {

            $this->kernel = $kernel;

            return $this->createDoctrineFacade();
        });
    }

    /**
     * @return DoctrineFacadeInterface
     */
    protected function createDoctrineFacade(): DoctrineFacadeInterface
    {
        return new DoctrineFacade($this->createManagerProvider());
    }

    /**
     * @return EntityManagerFactoryInterface
     */
    protected function createEntityManagerFactory(): EntityManagerFactoryInterface
    {
        return new EntityManagerFactory($this->configuration(), $this->createEntityManagerConfigurationFactory());
    }

    /**
     * @return EntityManagerConfigurationFactoryInterface
     */
    protected function createEntityManagerConfigurationFactory(): EntityManagerConfigurationFactoryInterface
    {
        return new EntityManagerConfigurationFactory(
            $this->kernel,
            $this->configuration()
        );
    }

    /**
     * @return ManagerProviderInterface
     */
    protected function createManagerProvider(): ManagerProviderInterface
    {
        return new ManagerProvider($this->createEntityManagerFactory());
    }

    /**
     * @return AppKernelInterface
     */
    protected function lookupKernel(): AppKernelInterface
    {
        return $this->container->get(AppKernelInterface::class);
    }
}
