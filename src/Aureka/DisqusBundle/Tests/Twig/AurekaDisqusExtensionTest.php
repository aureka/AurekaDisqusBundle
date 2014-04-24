<?php

namespace Aureka\DisqusBundle\Tests\Twig;

use Aureka\DisqusBundle\Twig\AurekaDisqusExtension;
use Aureka\DisqusBundle\Tests\Mocker;


class AurekaDisqusExtensionTest extends \PHPUnit_Framework_TestCase
{

    private $disqusable;
    private $environment;
    private $disqus;
    private $extension;
    private $mocker;


    public function setUp()
    {
        $this->mocker = new Mocker($this);
        $this->disqusable = $this->mocker->aDoubleOf('Aureka\DisqusBundle\Model\Disqusable', array(
            'getDisqusId' => 'some_disqus_id'
            ));
        $this->disqus = $this->mocker->aDoubleOf('Aureka\DisqusBundle\Model\Disqus', array(
            'getShortName' => 'short_name'));
        $this->environment = $this->mocker->aDoubleOf('Twig_Environment');
        $this->extension = new AurekaDisqusExtension($this->disqus, 'short_name');
    }


    /**
     * @test
     */
    public function itRendersTheAppropriateTemplateForTheDisqusThread()
    {
        $expected_array = array(
            'additional_vars' => array(
                'disqus_identifier' => 'some_disqus_id',
                ),
            'disqus' => $this->disqus,
            'remote_script' => 'embed.js'
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
            'additional_vars' => array(),
            'disqus' => $this->disqus,
            'remote_script' => 'count.js'
            );

        $this->environment->expects($this->once())
            ->method('render')
            ->with('AurekaDisqusBundle::disqus.html.twig', $expected_array);

        $this->extension->disqusCount($this->environment, $this->disqusable);
    }

}
