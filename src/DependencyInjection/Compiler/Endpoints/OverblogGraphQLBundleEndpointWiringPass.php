<?php

namespace Overblog\GraphiQLBundle\DependencyInjection\Compiler\Endpoints;

use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\RouteResolver;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class OverblogGraphQLBundleEndpointWiringPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $bundles = $container->getParameter('kernel.bundles_metadata');

        if (!array_key_exists('OverblogGraphQLBundle', $bundles)) {
            return;
        }

        $endpointDefinition = $container->getDefinition('overblog_graphiql.controller.graphql.endpoint');
        $endpointDefinition->setClass(RouteResolver::class);

        $endpointDefinition->setArguments([
            new Reference('router'),
            [$container->getParameter('overblog_graphiql.endpoint_resolver'), 'getByName'],
        ]);
    }
}
