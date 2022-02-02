<?php

namespace Micro\Plugin\Doctrine\Console;

use Doctrine\DBAL\Tools\Console\Command\ReservedWordsCommand;
use Doctrine\DBAL\Tools\Console\Command\RunSqlCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\CollectionRegionCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\EntityRegionCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\QueryRegionCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand;
use Doctrine\ORM\Tools\Console\Command\ConvertDoctrine1SchemaCommand;
use Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand;
use Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand;
use Doctrine\ORM\Tools\Console\Command\InfoCommand;
use Doctrine\ORM\Tools\Console\Command\MappingDescribeCommand;
use Doctrine\ORM\Tools\Console\Command\RunDqlCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand;
use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;

class DoctrineCommandProvider implements CommandProviderInterface
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     */
    public function __construct(private DoctrineFacadeInterface $doctrineFacade)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function list(): array
    {
        return [
            // DBAL Commands
            new ReservedWordsCommand($this->doctrineFacade),
            new RunSqlCommand($this->doctrineFacade),

            // ORM Commands
            new CollectionRegionCommand($this->doctrineFacade),
            new EntityRegionCommand($this->doctrineFacade),
            new MetadataCommand($this->doctrineFacade),
            new QueryCommand($this->doctrineFacade),
            new QueryRegionCommand($this->doctrineFacade),
            new ResultCommand($this->doctrineFacade),
            new CreateCommand($this->doctrineFacade),
            new UpdateCommand($this->doctrineFacade),
            new DropCommand($this->doctrineFacade),
            new GenerateProxiesCommand($this->doctrineFacade),
            new RunDqlCommand($this->doctrineFacade),
            new ValidateSchemaCommand($this->doctrineFacade),
            new InfoCommand($this->doctrineFacade),
            new MappingDescribeCommand($this->doctrineFacade),
        ];
    }
}
