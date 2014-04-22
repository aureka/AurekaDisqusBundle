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
        );
    }


    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('disqus_comments', array($this, 'disqusComments'), array('is_safe' => array('html'))),
        );
    }


    public function disqus(Disqusable $disqusable)
    {
        $vars = array(
            'disqus_shortname' => $this->shortName,
            'disqus_identifier' => $disqusable->getDisqusId(),
            );
        return '<div id="disqus_thread"></div>' . $this->encloseScript($this->addVars($vars, $this->remoteCall('embed.js')));
    }


    public function disqusComments()
    {
        $vars = array(
            'disqus_shortname' => $this->shortName,
            );
        return $this->encloseScript($this->addVars($vars, $this->remoteCall('count.js')));
    }


    private function encloseScript($input)
    {
        return '<script type="text/javascript">'.$input.'</script>';
    }


    private function addVars(array $vars, $input)
    {
        $variables = array();
        foreach ($vars as $key => $value) {
            $variables[] = sprintf('var %s="%s"', $key, $value);
        }
        return implode('', $variables).$input;
    }


    private function remoteCall($script_name)
    {
        return sprintf("(function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/%s';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();", $script_name);
    }


    public function getName()
    {
        return 'aureka_disqus_extension';
    }
}
