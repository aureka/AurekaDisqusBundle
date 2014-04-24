<?php

namespace Aureka\DisqusBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Aureka\DisqusBundle\Tests\Application\AppKernel;
use Aureka\DisqusBundle\Tests\Fixture\MyDisqusable;

class FunctionalTest extends WebTestCase
{

    private $disqusable;
    private $templating;

    protected static function createKernel(array $options = array())
    {
        return new AppKernel('test', true);
    }


    public function setUp()
    {
        $container = self::createClient()->getKernel()->getContainer();
        $this->disqusable = new MyDisqusable;
        $this->templating = $container->get('templating');
    }


    /**
     * @test
     */
    public function itProvidesADisqusFilterForDisqusComments()
    {
        $output = $this->templating->render('::thread.html.twig', array('disqusable' => $this->disqusable));

        $this->assertRegexp('/\<script/', $output);
    }


    /**
     * @test
     */
    public function itAddsTheDisqusThreadDivToDisqusThread()
    {
        $output = $this->templating->render('::thread.html.twig', array('disqusable' => $this->disqusable));

        $this->assertRegExp('/\<div id\=\"disqus_thread\"\>\<\/div\>/', $output);
    }


    /**
     * @test
     */
    public function itAddsTheShortNameToDisqusThread()
    {
        $output = $this->templating->render('::thread.html.twig', array('disqusable' => $this->disqusable));

        $this->assertRegExp('/var disqus_shortname="test_short_name"/', $output);
    }


    /**
     * @test
     */
    public function itAddsTheDisqusableIdentifierToDisqusThread()
    {
        $output = $this->templating->render('::thread.html.twig', array('disqusable' => $this->disqusable));

        $this->assertRegExp('/var disqus_identifier="test_id";/', $output);
    }


    /**
     * @test
     */
    public function itAddsTheShortNameToDisqusComments()
    {
        $output = $this->templating->render('::thread.html.twig', array('disqusable' => $this->disqusable));

        $this->assertRegExp('/var disqus_shortname="test_short_name";/', $output);
    }


    /**
     * @test
     */
    public function itAllowsDisablingTheSingleSignOn()
    {
        $output = $this->templating->render('::thread.html.twig', array('disqusable' => $this->disqusable));

        $this->assertNotRegExp('/page\.remote_auth_s3/', $output);
    }
}
