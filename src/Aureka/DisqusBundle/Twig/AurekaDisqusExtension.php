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
            new \Twig_SimpleFilter('disqus', array($this, 'disqus'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('disqus_comments', array($this, 'disqusComments'), array('is_safe' => array('html'))),
        );
    }


    public function disqus(Disqusable $disqusable)
    {
        return '<div id="disqus_thread"></div>' . $this->getScriptSnippet($disqusable, 'embed.js');
    }


    public function disqusComments(Disqusable $disqusable)
    {
        return $this->getScriptSnippet($disqusable, 'count.js');
    }


    private function getScriptSnippet(Disqusable $disqusable, $script_name)
    {
        return sprintf('<script type="text/javascript">'.
                'var disqus_shortname="%s";'.
                'var disqus_identifier="%s";'.
                "(function() {
                    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                    dsq.src = '//' + disqus_shortname + '.disqus.com/%s';
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    })();".
            '</script>', $this->shortName, $disqusable->getDisqusId(), $script_name);
    }


    public function getName()
    {
        return 'aureka_disqus_extension';
    }
}
