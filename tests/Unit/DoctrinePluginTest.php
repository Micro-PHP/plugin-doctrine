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

namespace Micro\Plugin\Doctrine\Test\Unit;

use Micro\Kernel\App\AppKernel;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Doctrine\DoctrinePlugin;
use PHPUnit\Framework\TestCase;

class DoctrinePluginTest extends TestCase
{
    public function testPlugin()
    {
        $kernel = new AppKernel(
            [
                'ORM_DEFAULT_DRIVER' => 'pdo_mysql',
                'ORM_PDO_MYSQL_DATABASE' => 'test',
            ],
            [DoctrinePlugin::class],
            'dev'
        );

        $kernel->run();
        /** @var DoctrineFacadeInterface $doctrine */
        $doctrine = $kernel->container()->get(DoctrineFacadeInterface::class);
        $manager = $doctrine->getManager();

        var_dump($manager->getConnection()->connect());
    }
}
