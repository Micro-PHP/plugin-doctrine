<?php

namespace Micro\Plugin\Doctrine;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Kernel\App\AppKernelInterface;
use Micro\Plugin\Console\CommandProviderInterface;
use Micro\Plugin\Doctrine\Business\EntityManager\EntityManagerConfigurationFactory;
use Micro\Plugin\Doctrine\Business\EntityManager\EntityManagerConfigurationFactoryInterface;
use Micro\Plugin\Doctrine\Console\CommandProviderInterface as PluginDoctrineCommandProviderInterface;
use Micro\Plugin\Doctrine\Business\EntityManager\EntityManagerFactory;
use Micro\Plugin\Doctrine\Business\EntityManager\EntityManagerFactoryInterface;
use Micro\Plugin\Doctrine\Business\EntityManager\ManagerProvider;
use Micro\Plugin\Doctrine\Business\EntityManager\ManagerProviderInterface;
use Micro\Plugin\Doctrine\Console\DoctrineCommandProvider;
use Symfony\Component\Console\Command\Command;

class DoctrinePlugin extends AbstractPlugin implements CommandProviderInterface
{
    private Container $container;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $this->container = $container;

        $container->register(DoctrineFacadeInterface::class, function (Container $container) {
            return $this->createDoctrineFacade();
        });
    }

    /**
     * @param Container $container
     * @return array|Command[]
     */
    public function provideConsoleCommands(Container $container): array
    {
        return $this->createCommandProviderInterface()->list();
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
        return new EntityManagerFactory($this->configuration, $this->createEntityManagerConfigurationFactory());
    }

    /**
     * @return EntityManagerConfigurationFactoryInterface
     */
    protected function createEntityManagerConfigurationFactory(): EntityManagerConfigurationFactoryInterface
    {
        return new EntityManagerConfigurationFactory($this->lookupKernel(),$this->configuration);
    }

    /**
     * @return ManagerProviderInterface
     */
    protected function createManagerProvider(): ManagerProviderInterface
    {
        return new ManagerProvider($this->createEntityManagerFactory());
    }

    /**
     * @return PluginDoctrineCommandProviderInterface
     */
    protected function createCommandProviderInterface(): PluginDoctrineCommandProviderInterface
    {
        return new DoctrineCommandProvider($this->lookupFacade());
    }

    /**
     * @return AppKernelInterface
     */
    protected function lookupKernel(): AppKernelInterface
    {
        return $this->container->get(AppKernelInterface::class);
    }

    /**
     * @return DoctrineFacadeInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function lookupFacade(): DoctrineFacadeInterface
    {
        return $this->container->get(DoctrineFacadeInterface::class);
    }
}
