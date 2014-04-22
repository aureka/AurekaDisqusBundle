<?php

namespace Aureka\DisqusBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Aureka\DisqusBundle\Tests\Application\AppKernel;
use Aureka\DisqusBundle\Tests\Fixture\MyDisqusable;

class FunctionalTest extends WebTestCase
{

    private $container;

    protected static function createKernel(array $options = array())
    {
        return new AppKernel('test', true);
    }


    public function setUp()
    {
        $this->container = self::createClient()->getKernel()->getContainer();
    }


    /**
     * @test
     */
    public function itProvidesADisqusFilterForDisqusComments()
    {
        $disqusable = new MyDisqusable;
        $templating = $this->container->get('templating');

        $output = $templating->render('::test.html.twig', array('disqusable' => $disqusable));

        $this->assertRegexp('/\&lt;script\&gt;/', $output);
    }
}
