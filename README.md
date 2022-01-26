# Micro Framework AMQP Component

Micro Framework plugin. Doctrine supports based on [doctrine/orm](https://www.doctrine-project.org/) library.

## Installation

Use the package manager [Composer](https://getcomposer.org/) to install.

```bash
composer require micro/plugin-doctrine
```

## Basic Configure

Append plugin to ./etc/plugins.php

```php
<?php 

return [
/*...... Other plugin list...*/
        Micro\Plugin\DOctrine\DoctrinePlugin::class,
];

```

## Basic Usage

#### Create configuration for default entity manager

```dotenv
ORM_DEFAULT_DRIVER=pdo_mysql 
ORM_DEFAULT_USER=mysql
ORM_DEFAULT_PASSWORD=password
ORM_DEFAULT_HOST=localhost
ORM_DEFAULT_DATABASE=app_db
```


#### Create Entity

```php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class ExampleEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;
    
    #[ORM\Column(type: 'string', length: 100)]
    private string $title;
    
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }
    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        
        return $this;
    }
}

```

#### Update Database schema

```bash
 $ php bin/console orm:schema-tool:create
```

#### Lookup Doctrine Facade for injections

```php
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;

$container->get(DoctrineFacadeInterface::class);
```

#### Save/Update/Create
```php
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;

$entity = new ExampleEntity();
$entity->setTitle('Hello World!');

/** @var  DoctrineFacadeInterface $doctrineFacade */
$doctrineFacade = $container->get(DoctrineFacadeInterface::class);

$manager = $doctrineFacade->getManager();
$manager->persist($entity);
$manager->flush();

```

## Other docs

 * ### [Full configuration list](docs/Configuration.md)
 * ### [Cli Tools overview](https://www.doctrine-project.org/projects/doctrine-orm/en/2.8/reference/tools.html#command-overview)




## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](LICENSE)
