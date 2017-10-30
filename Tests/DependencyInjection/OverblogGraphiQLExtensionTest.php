<?php

namespace Overblog\GraphiQLBundle\Tests\DependencyInjection;

use Overblog\GraphiQLBundle\Config\GraphiQLViewConfig;
use Overblog\GraphiQLBundle\Config\GraphiQLViewJavaScriptLibraries;
use Overblog\GraphiQLBundle\DependencyInjection\OverblogGraphiQLExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\DependencyInjection\Reference;

final class OverblogGraphiQLExtensionTest extends TestCase
{
    public function testLoadWithoutConfiguration()
    {
        $container = $this->createContainer();
        $container->registerExtension(new OverblogGraphiQLExtension());
        $container->loadFromExtension('overblog_graphiql');
        $this->compileContainer($container);

        $jsLibraries = $container->get('overblog_graphiql.view.config.javascript_libraries');

        $this->assertInstanceOf(GraphiQLViewJavaScriptLibraries::class, $jsLibraries);
        $this->assertSame('2.0', $jsLibraries->getFetchVersion());
        $this->assertSame('15.6', $jsLibraries->getReactVersion());
        $this->assertSame('0.11', $jsLibraries->getGraphiQLVersion());

        $viewConfig = $container->get('overblog_graphiql.view.config');

        $this->assertInstanceOf(GraphiQLViewConfig::class, $viewConfig);
        $this->assertSame('@OverblogGraphiQL/GraphiQL/index.html.twig', $viewConfig->getTemplate());
        $this->assertSame($jsLibraries, $viewConfig->getJavaScriptLibraries());

        $controllerDefinition = $container->getDefinition('overblog_graphiql.controller');
        $viewConfigArgument = $controllerDefinition->getArgument(1);
        $this->assertInstanceOf(Reference::class, $viewConfigArgument);
        $this->assertSame('overblog_graphiql.view.config', (string) $viewConfigArgument);
    }

    private function createContainer()
    {
        $container = new ContainerBuilder(new ParameterBag([
            'kernel.cache_dir' => __DIR__,
            'kernel.root_dir' => __DIR__.'/Fixtures',
            'kernel.charset' => 'UTF-8',
            'kernel.debug' => true,
            'kernel.bundles' => ['GraphiQLBundle' => 'Symfony\\Bundle\\DebugBundle\\GraphiQLBundle'],
        ]));

        return $container;
    }

    private function compileContainer(ContainerBuilder $container)
    {
        $container->getCompilerPassConfig()->setOptimizationPasses([]);
        $container->getCompilerPassConfig()->setRemovingPasses([]);
        $container->compile();
    }
}
