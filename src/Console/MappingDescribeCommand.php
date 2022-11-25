<?php

namespace Micro\Plugin\Doctrine\Console;

use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Doctrine\ORM\Tools\Console\Command\SchemaTool as ORM;

class MappingDescribeCommand extends ORM\CreateCommand
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     */
    public function __construct(DoctrineFacadeInterface $doctrineFacade)
    {
        parent::__construct($doctrineFacade);
    }
}