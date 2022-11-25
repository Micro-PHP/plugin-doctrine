<?php

namespace Micro\Plugin\Doctrine\Configuration\Locator;

interface EntityFileConfigurationLocatorInterface
{
    /**
     * @param object $plugin
     *
     * @return string[]
     */
    public function getPluginFiles(object $plugin): array;

    /**
     * @param object[] $pluginCollection
     *
     * @return string[]
     */
    public function getFiles(array $pluginCollection): array;
}
