<?php

namespace Micro\Plugin\Doctrine\Configuration\Locator;

class AttributeEntityFileConfigurationLocator implements EntityFileConfigurationLocatorInterface
{
    /**
     * {@inheritDoc}
     */
    public function getPluginFiles(object $plugin): array
    {
        $reflection = new \ReflectionClass($plugin);

        return [
            dirname($reflection->getFileName()),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getFiles(iterable $pluginCollection): array
    {
        $files = [];

        foreach ($pluginCollection as $plugin) {
            $files[] = $this->getPluginFiles($plugin);
        }

        return array_merge(...$files);
    }
}
