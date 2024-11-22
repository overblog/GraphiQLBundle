<?php

declare(strict_types=1);

namespace Overblog\GraphiQLBundle\DependencyInjection;

use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\Helpers\OverblogGraphQLBundleEndpointResolver;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

use function method_exists;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('overblog_graphiql');
        $rootNode = $treeBuilder->getRootNode();

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

    /**
     * @param string|null $name
     * @param string      $type
     *
     * @return ArrayNodeDefinition|\Symfony\Component\Config\Definition\Builder\NodeDefinition
     */
    private static function getRootNodeWithoutDeprecation(TreeBuilder $builder, $name, $type = 'array')
    {
        // BC layer for symfony/config 4.1 and older
        return method_exists($builder, 'getRootNode') ? $builder->getRootNode() : $builder->root($name, $type);
    }
}
