<?php

namespace Overblog\GraphiQLBundle\DependencyInjection;

use Overblog\GraphiQLBundle\Config\GraphiQLViewConfig;
use Overblog\GraphiQLBundle\Config\GraphiQLViewJavascriptLibraries;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * DebugExtension.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class OverblogGraphiQLExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $javaScriptLibraries = new GraphiQLViewJavascriptLibraries(
            $config['javascript_libraries']['graphiql'],
            $config['javascript_libraries']['react'],
            $config['javascript_libraries']['fetch']
        );

        $graphiQLViewConfigDefinition = new Definition(
            GraphiQLViewConfig::class,
            [
                $javaScriptLibraries,
                $config['template'],
            ]
        );

        $container->setDefinition('overblog_graphiql.view.config', $graphiQLViewConfigDefinition);
    }

    public function getAlias()
    {
        return 'overblog_graphiql';
    }

    /**
     * {@inheritdoc}
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    /**
     * {@inheritdoc}
     */
    public function getNamespace()
    {
        return 'http://symfony.com/schema/dic/debug';
    }
}
