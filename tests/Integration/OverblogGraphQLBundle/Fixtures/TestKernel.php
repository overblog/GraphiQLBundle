<?php

namespace Overblog\GraphiQLBundle\Tests\Integration\OverblogGraphQLBundle\Fixtures;

use Overblog\GraphiQLBundle\OverblogGraphiQLBundle;
use Overblog\GraphiQLBundle\Tests\TestKernel as AbstractTestKernel;
use Overblog\GraphQLBundle\OverblogGraphQLBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class TestKernel extends AbstractTestKernel
{
    public function registerBundles(): array
    {
        return [
            new FrameworkBundle(),
            new TwigBundle(),
            new OverblogGraphQLBundle(),
            new OverblogGraphiQLBundle(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) {
            $container->loadFromExtension('framework', [
                'secret' => 'test',
                'test' => true,
                'assets' => ['enabled' => false],
                'router' => [
                    'resource' => __DIR__.'/Resources/config/routing.xml',
                ],
            ]);
        });
    }
}
