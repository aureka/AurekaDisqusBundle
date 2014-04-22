<?php

namespace Aureka\DisqusBundle\Tests\Twig;

use Aureka\DisqusBundle\Twig\AurekaDisqusExtension;


class AurekaDisqusExtensionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function itAddsTheShortName()
    {
        $disqusable = $this->getMock('Aureka\DisqusBundle\Model\Disqusable');
        $extension = new AurekaDisqusExtension('short_name');

        $output = $extension->disqus($disqusable);

        //var disqus_shortname = "{{ site.disqus_shortname }}";
        $this->assertRegExp('/var disqus_shortname="short_name"/', $output);
    }
}