<?php

namespace Aureka\DisqusBundle\Twig;

use Aureka\DisqusBundle\Model\Disqusable;

class AurekaDisqusExtension extends \Twig_Extension
{

    private $shortName;


    public function __construct($short_name)
    {
        $this->shortName = $short_name;
    }


    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('disqus', array($this, 'disqus')),
        );
    }


    public function disqus(Disqusable $disqusable)
    {
        $output = '<div id="disqus_thread"></div>'.
                  '<script type="text/javascript">'.
                      'var disqus_shortname="%s";'.
                      'var disqus_identifier="%s";'.
                      "(function() {
                            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                        })();".
                  '</script>';
        return sprintf($output, $this->shortName, $disqusable->getDisqusId());
    }


    public function getName()
    {
        return 'aureka_disqus_extension';
    }
}
