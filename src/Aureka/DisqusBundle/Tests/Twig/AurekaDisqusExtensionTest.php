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
    public function itAddsTheDisqusThreadDivToDisqusThread()
    {
        $environment = $this->getMock('Twig_Environment');

        $output = $this->extension->disqus($environment, $this->disqusable);

        $this->assertRegExp('/\<div id\=\"disqus_thread\"\>\<\/div\>/', $output);
    }


    /**
     * @test
     */
    public function itAddsTheShortNameToDisqusThread()
    {
        $environment = $this->getMock('Twig_Environment');

        $output = $this->extension->disqus($environment, $this->disqusable);

        $this->assertRegExp('/var disqus_shortname="short_name"/', $output);
    }


    /**
     * @test
     */
    public function itAddsTheDisqusableIdentifierToDisqusThread()
    {
        $environment = $this->getMock('Twig_Environment');
        $this->disqusable->expects($this->any())
            ->method('getDisqusId')
            ->will($this->returnValue('disqus_id/4444'));

        $output = $this->extension->disqus($environment, $this->disqusable);

        $this->assertRegExp('/var disqus_identifier="disqus_id\/4444";/', $output);
    }


    /**
     * @test
     */
    public function itAddsTheShortNameToDisqusComments()
    {
        $output = $this->extension->disqusComments();

        $this->assertRegExp('/var disqus_shortname="short_name";/', $output);
    }

}