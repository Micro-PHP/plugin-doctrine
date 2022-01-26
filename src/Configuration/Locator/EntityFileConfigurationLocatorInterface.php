<?php

namespace Micro\Plugin\Doctrine\Configuration\Locator;

use Micro\Framework\Kernel\Plugin\ApplicationPluginInterface;

interface EntityFileConfigurationLocatorInterface
{
    /**
     * @param ApplicationPluginInterface $plugin
     *
     * @return string[]
     */
    public function getPluginFiles(ApplicationPluginInterface $plugin): array;

    /**
     * @param ApplicationPluginInterface[] $pluginCollection
     *
     * @return string[]
     */
    public function getFiles(array $pluginCollection): array;
}
