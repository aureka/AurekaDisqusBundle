<?php

namespace Aureka\DisqusBundle\Twig;

class AurekaDisqusExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('disqus', array($this, 'disqus')),
        );
    }

    public function disqus($disqusable)
    {
        return '<script></script>';
    }

    public function getName()
    {
        return 'aureka_disqus_extension';
    }
}
