<?php

namespace Micro\Plugin\Doctrine\Console;

use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Doctrine\ORM\Tools\Console\Command as ORM;

class InfoCommand extends ORM\InfoCommand
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     */
    public function __construct(DoctrineFacadeInterface $doctrineFacade)
    {
        parent::__construct($doctrineFacade);
    }
}