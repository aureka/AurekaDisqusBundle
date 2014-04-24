<?php

namespace Aureka\DisqusBundle\Tests\Twig;

use Aureka\DisqusBundle\Model\Disqus;


class DisqusTest extends \PHPUnit_Framework_TestCase
{

    const PRIVATE_KEY = 'EYuDqiVgY7z9viAaD8rZiLyUL73ezB7MTKzbhl15LnkTM5mDkVWaeSfACIZyLw2c';
    const API_KEY     = 'psqOrbPBwapsYo4noDooKBAYexeJkitpnUttryVjyRITKOZBVEQL7mOMxCScs7x0';
    const TIMESTAMP   = 1398239523;


    private $disqus;

    public function setUp()
    {
        $this->disqus = new Disqus('my_web', self::PRIVATE_KEY, self::API_KEY);
    }


    /**
     * @test
     */
    public function itDoesGeneratesAHashForAUser()
    {
        $user = $this->aDoubleOf('Aureka\DisqusBundle\Model\DisqusUser');

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
}
