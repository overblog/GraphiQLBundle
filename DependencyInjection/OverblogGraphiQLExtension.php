<?php

namespace Overblog\GraphiQLBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

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

        $graphiQLViewConfigJSLibraries = $container->getDefinition('overblog_graphiql.view.config.javascript_libraries');
        $graphiQLViewConfigJSLibraries->setArguments([
            $config['javascript_libraries']['graphiql'],
            $config['javascript_libraries']['react'],
            $config['javascript_libraries']['fetch'],
        ]);

        $graphiQLViewConfig = $container->getDefinition('overblog_graphiql.view.config');
        $graphiQLViewConfig->setArguments([
            new Reference('overblog_graphiql.view.config.javascript_libraries'),
            $config['template'],
        ]);
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
        return 'http://over-blog.com/schema/dic/overblog_graphiql';
    }
}
