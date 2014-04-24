<?php

namespace Aureka\DisqusBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Aureka\DisqusBundle\Tests\Application\AppKernel;
use Aureka\DisqusBundle\Tests\Fixture\MyDisqusable;

class FunctionalTest extends WebTestCase
{

    private $templating;
    private $disqus;
    private $disqusable;

    protected static function createKernel(array $options = array())
    {
        return new AppKernel('test', true);
    }


    public function setUp()
    {
        $container = self::createClient()->getKernel()->getContainer();
        $this->templating = $container->get('templating');
        $this->disqus = $container->get('aureka_disqus.disqus');
        $this->disqusable = new MyDisqusable;
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


    /**
     * @test
     */
    public function itAllowsEnablingTheSingleSignOn()
    {
        $this->disqus->enableSingleSingOn();

        $output = $this->templating->render('::thread.html.twig', array('disqusable' => $this->disqusable));

        $this->assertRegExp('/page\.remote_auth_s3/', $output);
        $this->assertRegExp('/this\.page\.remote_auth_s3/', $output);
        $this->assertRegExp('/this\.page\.api_key/', $output);
    }
}
