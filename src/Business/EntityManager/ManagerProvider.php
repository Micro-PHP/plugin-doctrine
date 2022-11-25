<?php

namespace Micro\Plugin\Doctrine\Business\EntityManager;

use Doctrine\ORM\EntityManagerInterface;

class ManagerProvider implements ManagerProviderInterface
{
    /**
     * @var array<String, EntityManagerInterface>
     */
    private array $entityManagerCollection;

    /**
     * @param EntityManagerFactoryInterface $entityManagerFactory
     */
    public function __construct(private readonly EntityManagerFactoryInterface $entityManagerFactory)
    {
        $this->entityManagerCollection = [];
    }

    /**
     * @param string $managerAlias
     * @return EntityManagerInterface
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function getManager(string $managerAlias): EntityManagerInterface
    {
        if(
            !array_key_exists($managerAlias, $this->entityManagerCollection) ||
            !$this->entityManagerCollection[$managerAlias]->isOpen())
        {
            $this->entityManagerCollection[$managerAlias] = $this->entityManagerFactory->create($managerAlias);
        }

        return $this->entityManagerCollection[$managerAlias];
    }
}
