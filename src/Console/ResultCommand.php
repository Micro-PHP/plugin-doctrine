<?php

namespace Micro\Plugin\Doctrine\Console;

use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Doctrine\ORM\Tools\Console\Command as ORM;

class ResultCommand extends ORM\ClearCache\ResultCommand
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     */
    public function __construct(DoctrineFacadeInterface $doctrineFacade)
    {
        parent::__construct($doctrineFacade);
    }
}