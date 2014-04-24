<?php

namespace Aureka\DisqusBundle\Twig;

use Aureka\DisqusBundle\Model\Disqusable,
    Aureka\DisqusBundle\Model\DisqusConfiguration;

class AurekaDisqusExtension extends \Twig_Extension
{

    private $shortName;
    private $configuration;


    public function __construct(DisqusConfiguration $configuration, $short_name)
    {
        $this->shortName = $short_name;
        $this->configuration = $configuration;
    }


    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('disqus', array($this, 'disqus'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('disqus_count', array($this, 'disqusCount'), array('is_safe' => array('html'), 'needs_environment' => true)),
        );
    }


    public function disqus(\Twig_Environment $env, Disqusable $disqusable)
    {
        return $env->render('AurekaDisqusBundle::thread.html.twig', array(
            'vars' => array(
                'disqus_shortname' => $this->shortName,
                'disqus_identifier' => $disqusable->getDisqusId(),
                ),
            'configuration' => $this->configuration,
            'remote_script' => 'comment.js',
            ));
    }


    public function disqusCount(\Twig_Environment $env)
    {
        return $env->render('AurekaDisqusBundle::disqus.html.twig', array(
            'vars' => array(
                'disqus_shortname' => $this->shortName,
                ),
            'configuration' => $this->configuration,
            'remote_script' => 'count.js'
            ));
    }


    public function getName()
    {
        return 'aureka_disqus_extension';
    }
}
