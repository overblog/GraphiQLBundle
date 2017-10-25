<?php

namespace Overblog\GraphiQLBundle\DependencyInjection\Compiler\Endpoints;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class OverblogGraphQLBundleEndpointWiringPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles_metadata');

        if (!array_key_exists('OverblogGraphQLBundle', $bundles)) {
            return;
        }

        // @todo add schemas to RouteResolver
    }
}
