<?php

namespace Aureka\DisqusBundle\Tests\Twig;

use Aureka\DisqusBundle\Twig\AurekaDisqusExtension;


class AurekaDisqusExtensionTest extends \PHPUnit_Framework_TestCase
{

    private $disqusable;
    private $environment;
    private $sso;
    private $extension;


    public function setUp()
    {
        $this->disqusable = $this->getMock('Aureka\DisqusBundle\Model\Disqusable');
        $this->sso = $this->getMock('Aureka\DisqusBundle\Model\SingleSignOn');
        $this->disqusable->expects($this->any())
            ->method('getDisqusId')
            ->will($this->returnValue('some_disqus_id'));
        $this->environment = $this->getMock('Twig_Environment');
        $this->extension = new AurekaDisqusExtension($this->sso, 'short_name');
    }


    /**
     * @test
     */
    public function itRendersTheAppropriateTemplateForTheDisqusThread()
    {
        $expected_array = array(
            'vars' => array(
                'disqus_shortname' => 'short_name',
                'disqus_identifier' => 'some_disqus_id',
                ),
            'sso' => $this->sso,
            'remote_script' => 'comment.js'
            );

        $this->environment->expects($this->once())
            ->method('render')
            ->with('AurekaDisqusBundle::thread.html.twig', $expected_array);

        $this->extension->disqus($this->environment, $this->disqusable);
    }


    /**
     * @test
     */
    public function itRendersTheAppropriateTemplateForTheDisqusCommentCount()
    {
        $expected_array = array(
            'vars' => array(
                'disqus_shortname' => 'short_name',
                ),
            'sso' => $this->sso,
            'remote_script' => 'count.js'
            );

        $this->environment->expects($this->once())
            ->method('render')
            ->with('AurekaDisqusBundle::disqus.html.twig', $expected_array);

        $this->extension->disqusCount($this->environment, $this->disqusable);
    }

}
