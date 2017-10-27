<?php

namespace Overblog\GraphiQLBundle\Tests\Fixtures;

use Overblog\GraphiQLBundle\OverblogGraphiQLBundle;
use Overblog\GraphiQLBundle\Tests\TestKernel as AbstractTestKernel;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class TestKernel extends AbstractTestKernel
{
    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
            new TwigBundle(),
            new OverblogGraphiQLBundle(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) {
            $container->loadFromExtension('framework', [
                'secret' => 'test',
                'test' => true,
                'templating' => ['engine' => ['twig']],
                'assets' => ['enabled' => false],
                'router' => ['resource' => '%kernel.root_dir%/../Resources/config/routing.xml'],
            ]);
        });
    }
}
