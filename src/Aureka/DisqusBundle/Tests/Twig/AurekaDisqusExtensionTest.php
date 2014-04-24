<?php

namespace Aureka\DisqusBundle\Tests\Twig;

use Aureka\DisqusBundle\Twig\AurekaDisqusExtension;


class AurekaDisqusExtensionTest extends \PHPUnit_Framework_TestCase
{

    private $disqusable;
    private $environment;
    private $configuration;
    private $extension;


    public function setUp()
    {
        $this->disqusable = $this->aDoubleOf('Aureka\DisqusBundle\Model\Disqusable', array(
            'getDisqusId' => 'some_disqus_id'
            ));
        $this->configuration = $this->aDoubleOf('Aureka\DisqusBundle\Model\DisqusConfiguration', array(
            'getShortName' => 'short_name'));
        $this->environment = $this->getMock('Twig_Environment');
        $this->extension = new AurekaDisqusExtension($this->configuration, 'short_name');
    }


    private function aDoubleOf($class_name, array $stubs = array()) {
        $double = $this->getMockBuilder($class_name)
            ->disableOriginalConstructor()
            ->getMock();

        foreach ($stubs as $method => $return_value) {
            $double->expects($this->any())
                ->method($method)
                ->will($this->returnValue($return_value));
        }

        return $double;
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
            'configuration' => $this->configuration,
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
            'additional_vars' => array(),
            'configuration' => $this->configuration,
            'remote_script' => 'count.js'
            );

        $this->environment->expects($this->once())
            ->method('render')
            ->with('AurekaDisqusBundle::disqus.html.twig', $expected_array);

        $this->extension->disqusCount($this->environment, $this->disqusable);
    }

}
