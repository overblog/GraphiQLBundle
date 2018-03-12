<?php

namespace Overblog\GraphiQLBundle\DependencyInjection;

use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\Helpers\EndpointResolverInterface;
use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\Helpers\OverblogGraphQLBundleEndpointResolver;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('overblog_graphiql');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('endpoint_resolver')
                    ->defaultValue(OverblogGraphQLBundleEndpointResolver::class)
                ->end()
                ->scalarNode('template')
                    ->info('In case you need it\'s possible to replace GraphiQL twig template')
                    ->defaultValue('@OverblogGraphiQL/GraphiQL/index.html.twig')
                ->end()
                ->arrayNode('javascript_libraries')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('graphiql')->defaultValue('0.11')->end()
                        ->scalarNode('react')->defaultValue('15.6')->end()
                        ->scalarNode('fetch')->defaultValue('2.0')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
