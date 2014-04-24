<?php

namespace Aureka\DisqusBundle\Tests\Twig;

use Aureka\DisqusBundle\Model\Disqus;
use Aureka\DisqusBundle\Tests\Mocker;

class DisqusTest extends \PHPUnit_Framework_TestCase
{

    private $disqus;
    private $mocker;

    public function setUp()
    {
        $this->mocker = new Mocker($this);
        $this->disqus = new Disqus('my_web', '', '');
    }


    /**
     * @test
     */
    public function itDoesGeneratesAHashForAUser()
    {
        $user = $this->mocker->aDoubleOf('Aureka\DisqusBundle\Model\DisqusUser');

        $hash = $this->disqus->getSingleSignOnHash($user);

        $this->assertNotEquals('', $hash);
    }


    /**
     * @test
     */
    public function itDoesNotGenerateAHashIfNoUserIsProvided()
    {
        $hash = $this->disqus->getSingleSignOnHash(null);

        $this->assertEquals('', $hash);
    }
}
