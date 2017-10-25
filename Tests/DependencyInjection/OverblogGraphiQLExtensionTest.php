<?php

namespace Overblog\GraphiQLBundle\Tests\DependencyInjection;

use Overblog\GraphiQLBundle\DependencyInjection\OverblogGraphiQLExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class OverblogGraphiQLExtensionTest extends TestCase
{
    public function testLoadWithoutConfiguration()
    {
        $container = $this->createContainer();
        $container->registerExtension(new OverblogGraphiQLExtension());
        $container->loadFromExtension('overblog_graphiql');
        $this->compileContainer($container);

        $bundleConfig = $container->getParameter('overblog_graphiql.config');

        $this->assertEquals([
            'template' => '@OverblogGraphiQL/GraphiQL/index.html.twig',
            'javascript_libraries' =>
                [
                    'graphiql' => '0.11',
                    'react' => '15.6',
                    'fetch' => '2.0',
                    'relay' => 'classic',
                ],
        ], $bundleConfig);
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
        $container->getCompilerPassConfig()->setOptimizationPasses(array());
        $container->getCompilerPassConfig()->setRemovingPasses(array());
        $container->compile();
    }
}
