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


        $container->setParameter('aureka_disqus.short_name', $config['short_name']);

        $sso = new Definition('Aureka\DisqusBundle\Model\SingleSignOn');
        $sso->setFactoryClass('Aureka\DisqusBundle\Model\SingleSignOn');
        $sso->setFactoryMethod('fromArray');
        $sso->addArgument($config['sso']);
        $container->setDefinition('aureka_disqus.sso', $sso);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }


    public function getAlias()
    {
        return 'aureka_disqus';
    }
}
