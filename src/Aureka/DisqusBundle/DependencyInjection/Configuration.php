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
                ->arrayNode('sso')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('enabled')->defaultValue(false)->end()
                        ->scalarNode('api_key')->defaultValue('')->end()
                        ->scalarNode('private_key')->defaultValue('')->end()
                    ->end()
                ->end()
            ->end();
        return $treeBuilder;
    }

}