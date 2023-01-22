<?php

declare(strict_types=1);

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Micro\Plugin\Doctrine\Business\Pool\EntityManagerPoolFactoryInterface;
use Micro\Plugin\Doctrine\Business\Pool\EntityManagerPoolInterface;

class DoctrineFacade implements DoctrineFacadeInterface
{
    private EntityManagerPoolInterface|null $managerPool;

    public function __construct(private readonly EntityManagerPoolFactoryInterface $managerPoolFactory)
    {
        $this->managerPool = null;
    }

    public function getManager(string $managerName = null): EntityManagerInterface
    {
        if (!$managerName) {
            $managerName = DoctrinePluginConfigurationInterface::MANAGER_DEFAULT;
        }

        return $this->managerPool()->getManager($managerName);
    }

    protected function managerPool(): EntityManagerPoolInterface
    {
        if (null === $this->managerPool) {
            $this->managerPool = $this->managerPoolFactory->create();
        }

        return $this->managerPool;
    }
}
