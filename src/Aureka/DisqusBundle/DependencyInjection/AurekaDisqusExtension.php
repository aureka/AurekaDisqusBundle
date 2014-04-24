<?php

namespace Aureka\DisqusBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;


class AurekaDisqusExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);


        $disqus_config = new Definition('Aureka\DisqusBundle\Model\Disqus');
        $disqus_config->setFactoryClass('Aureka\DisqusBundle\Model\Disqus');
        $disqus_config->setFactoryMethod('create');
        $disqus_config->addArgument($config['sso']);
        $disqus_config->addArgument($config['short_name']);
        $container->setDefinition('aureka_disqus.disqus', $disqus_config);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }


    public function getAlias()
    {
        return 'aureka_disqus';
    }
}
