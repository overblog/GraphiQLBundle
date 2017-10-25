<?php

namespace Overblog\GraphiQLBundle\DependencyInjection\Compiler\Endpoints;

use Overblog\GraphiQLBundle\Config\GraphiQLControllerEndpoint;
use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\RootResolver;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DefaultEndpointWiringPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $endpointDefinition = $container->getDefinition('overblog_graphiql.controller.graphql.endpoint');

        if ($endpointDefinition->getClass() !== GraphiQLControllerEndpoint::class) {
            return;
        }

        $endpointDefinition->setClass(RootResolver::class);
    }
}
