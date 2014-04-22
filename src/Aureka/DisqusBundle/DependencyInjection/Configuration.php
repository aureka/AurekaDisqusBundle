<?php

namespace Aureka\DisqusBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('aureka_disqus');
        $rootNode
            ->children()
                ->scalarNode('short_name')->isRequired()->end()
            ->end();
        return $treeBuilder;
    }

}