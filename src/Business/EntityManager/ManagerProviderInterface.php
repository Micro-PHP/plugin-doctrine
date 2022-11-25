<?php

namespace Micro\Plugin\Doctrine\Business\EntityManager;

use Doctrine\ORM\EntityManagerInterface;

interface ManagerProviderInterface
{
    /**
     * @param string $managerAlias
     *
     * @return EntityManagerInterface
     */
    public function getManager(string $managerAlias): EntityManagerInterface;
}
