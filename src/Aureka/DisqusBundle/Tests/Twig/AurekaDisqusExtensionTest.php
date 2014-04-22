<?php

namespace Aureka\DisqusBundle\Tests\Twig;

use Aureka\DisqusBundle\Twig\AurekaDisqusExtension;


class AurekaDisqusExtensionTest extends \PHPUnit_Framework_TestCase
{

    private $disqusable;
    private $extension;


    public function setUp()
    {
        $this->disqusable = $this->getMock('Aureka\DisqusBundle\Model\Disqusable');
        $this->extension = new AurekaDisqusExtension('short_name');

    }


    /**
     * @test
     */
    public function itAddsTheDisqusThreadDiv()
    {
        $output = $this->extension->disqus($this->disqusable);

        $this->assertRegExp('/\<div id\=\"disqus_thread\"\>\<\/div\>/', $output);
    }


    /**
     * @test
     */
    public function itAddsTheShortName()
    {
        $output = $this->extension->disqus($this->disqusable);

        $this->assertRegExp('/var disqus_shortname="short_name"/', $output);
    }
}