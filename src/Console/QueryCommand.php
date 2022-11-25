<?php

namespace Micro\Plugin\Doctrine\Console;

use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Doctrine\ORM\Tools\Console\Command as ORM;

class QueryCommand extends ORM\ClearCache\QueryCommand
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     */
    public function __construct(DoctrineFacadeInterface $doctrineFacade)
    {
        parent::__construct($doctrineFacade);
    }
}