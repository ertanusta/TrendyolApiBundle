<?php

namespace Trendyol\ApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('trendyol_api');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('supplier_id')->defaultValue('')->end()
                ->scalarNode('app_key')->defaultValue('')->end()
                ->scalarNode('app_secret')->defaultValue('')->end()
                ->scalarNode('integrator')->defaultValue('')->end()
                ->scalarNode('url_file_path')->defaultValue(null)->end()
            ->end()
            ->end();
        return $treeBuilder;
    }
}