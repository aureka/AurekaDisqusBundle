<?php

namespace Aureka\DisqusBundle\Twig;

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


    public function disqus($disqusable)
    {
        $output = '<script type="text/javascript">'.
                      'var disqus_shortname="%s";'.
                  '</script>';
        return sprintf($output, $this->shortName);
    }


    public function getName()
    {
        return 'aureka_disqus_extension';
    }
}


/*
<div id="disqus_thread"></div>

<script type="text/javascript">
    var disqus_shortname = "{{ site.disqus_shortname }}";
    var disqus_identifier = "node/19759";

    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
*/