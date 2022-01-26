<?php

namespace Micro\Plugin\Doctrine\Configuration\Locator;

use Micro\Framework\Kernel\Plugin\ApplicationPluginInterface;

class AttributeEntityFileConfigurationLocator implements EntityFileConfigurationLocatorInterface
{

    public function getPluginFiles(ApplicationPluginInterface $plugin): array
    {
        $reflection = new \ReflectionClass($plugin);

        return [
            dirname($reflection->getFileName()),
        ];
    }

    /**
     * @param ApplicationPluginInterface[] $pluginCollection
     *
     * @return string[]
     */
    public function getFiles(array $pluginCollection): array
    {
        $files = [];

        foreach ($pluginCollection as $plugin) {
            $files[] = $this->getPluginFiles($plugin);
        }

        return array_merge(...$files);
    }
}
