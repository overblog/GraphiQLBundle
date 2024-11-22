<?php

declare(strict_types=1);

namespace Overblog\GraphiQLBundle;

use Overblog\GraphiQLBundle\DependencyInjection\Compiler\Endpoints\DefaultEndpointWiringPass;
use Overblog\GraphiQLBundle\DependencyInjection\Compiler\Endpoints\OverblogGraphQLBundleEndpointWiringPass;
use Overblog\GraphiQLBundle\DependencyInjection\OverblogGraphiQLExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class OverblogGraphiQLBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new OverblogGraphQLBundleEndpointWiringPass());

        // DefaultEndpointWiringPass should always be the last one to
        // provide the route in case no other wiring has succeeded
        $container->addCompilerPass(new DefaultEndpointWiringPass());
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new OverblogGraphiQLExtension();
    }
}
