<?php

namespace Overblog\GraphiQLBundle\DependencyInjection\Compiler\Endpoints;

use Overblog\GraphiQLBundle\Config\GraphiQLControllerEndpoint;
use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\RootResolver;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class DefaultEndpointWiringPass implements CompilerPassInterface
{
    // @todo https://github.com/symfony/symfony/blob/master/src/Symfony/Component/DependencyInjection/Tests/Compiler/RemoveUnusedDefinitionsPassTest.php
    public function process(ContainerBuilder $container): void
    {
        $endpointDefinition = $container->getDefinition('overblog_graphiql.controller.graphql.endpoint');

        if (GraphiQLControllerEndpoint::class !== $endpointDefinition->getClass()) {
            return;
        }

        $endpointDefinition->setClass(RootResolver::class);
    }
}
