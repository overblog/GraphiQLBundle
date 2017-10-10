<?php

namespace Overblog\GraphiQLBundle;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * DebugExtension configuration structure.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('overblog_graphql');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('template')
                    ->info('In case you need it\'s possible to replace GraphiQL twig template')
                    ->defaultValue('@OverblogGraphQL/GraphiQL/index.html.twig')
                ->end()
                ->arrayNode('javascript_libraries')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('graphiql')->defaultValue('0.11')->end()
                        ->scalarNode('react')->defaultValue('15.6')->end()
                        ->scalarNode('fetch')->defaultValue('2.0')->end()
                        ->enumNode('relay')->values(['modern', 'classic'])->defaultValue('classic')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
