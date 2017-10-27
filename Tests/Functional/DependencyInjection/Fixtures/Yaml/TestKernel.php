<?php

namespace Overblog\GraphiQLBundle\Tests\Functional\DependencyInjection\Fixtures\Yaml;

use Overblog\GraphiQLBundle\OverblogGraphiQLBundle;
use Overblog\GraphiQLBundle\Tests\TestKernel as AbstractTestKernel;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;

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
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config.yml');
    }
}
