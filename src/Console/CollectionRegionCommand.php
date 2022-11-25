<?php

namespace Micro\Plugin\Doctrine\Console;

use Doctrine\ORM\Tools\Console\Command as ORM;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;

class CollectionRegionCommand extends ORM\ClearCache\CollectionRegionCommand
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     */
    public function __construct(
        DoctrineFacadeInterface $doctrineFacade
    )
    {
        parent::__construct($doctrineFacade);
    }
}