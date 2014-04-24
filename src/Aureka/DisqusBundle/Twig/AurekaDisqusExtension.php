<?php

namespace Aureka\DisqusBundle\Twig;

use Aureka\DisqusBundle\Model\Disqusable,
    Aureka\DisqusBundle\Model\Disqus;

class AurekaDisqusExtension extends \Twig_Extension
{

    private $disqus;


    public function __construct(Disqus $disqus)
    {
        $this->disqus = $disqus;
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
            'additional_vars' => array(
                'disqus_identifier' => $disqusable->getDisqusId(),
                ),
            'disqus' => $this->disqus,
            'remote_script' => 'comment.js',
            ));
    }


    public function disqusCount(\Twig_Environment $env)
    {
        return $env->render('AurekaDisqusBundle::disqus.html.twig', array(
            'additional_vars' => array(),
            'disqus' => $this->disqus,
            'remote_script' => 'count.js'
            ));
    }


    public function getName()
    {
        return 'aureka_disqus_extension';
    }
}
