<?php

namespace Micro\Plugin\Doctrine\Console;

use Symfony\Component\Console\Command\Command;

interface CommandProviderInterface
{
    /**
     * @return Command[];
     */
    public function list(): array;
}
