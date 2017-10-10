<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Overblog\GraphiQLBundle\Tests\DependencyInjection;

use Overblog\GraphiQLBundle\DependencyInjection\OverblogGraphiQLExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class GraphiQLExtensionTest extends TestCase
{
    public function testLoadWithoutConfiguration()
    {
        $container = $this->createContainer();
        $container->registerExtension(new OverblogGraphiQLExtension());
        $container->loadFromExtension('overblog_graphiql');
        $this->compileContainer($container);

        $expectedTags = array(
            array(
                'id' => 'dump',
                'template' => '@Debug/Profiler/dump.html.twig',
                'priority' => 240,
            ),
        );

        $this->assertSame($expectedTags, $container->getDefinition('data_collector.dump')->getTag('data_collector'));
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
