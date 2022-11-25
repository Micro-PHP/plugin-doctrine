<?php

namespace Micro\Plugin\Doctrine\Console;

use Doctrine\ORM\Tools\Console\Command\SchemaTool as ORM;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;

class CreateCommand extends ORM\CreateCommand
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     */
    public function __construct(DoctrineFacadeInterface $doctrineFacade)
    {
        parent::__construct($doctrineFacade);
    }
}