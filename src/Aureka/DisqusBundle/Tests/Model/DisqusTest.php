<?php

namespace Aureka\DisqusBundle\Tests\Twig;

use Aureka\DisqusBundle\Model\Disqus;


class DisqusTest extends \PHPUnit_Framework_TestCase
{

    const PRIVATE_KEY = 'EYuDqiVgY7z9viAaD8rZiLyUL73ezB7MTKzbhl15LnkTM5mDkVWaeSfACIZyLw2c';
    const API_KEY     = 'psqOrbPBwapsYo4noDooKBAYexeJkitpnUttryVjyRITKOZBVEQL7mOMxCScs7x0';
    const TIMESTAMP   = 1398239523;


    /**
     * @test
     */
    public function itGeneratesASingleSignOnHash()
    {
        $user = $this->aDoubleOf('Aureka\DisqusBundle\Model\DisqusUser',
            array(
                'getDisqusId' => 56,
                'getUsername' => 'someone',
                'getEmail' => 'someones@email.is'
                ));
        $disqus = new Disqus('my_web', self::PRIVATE_KEY, self::API_KEY);
        $expected_hash = 'eyJpZCI6NTYsInVzZXJuYW1lIjoic29tZW9uZSIsImVtYWlsIjoic29tZW9uZXNAZW1haWwuaXMifQ== 71ac24d3f28450adad62de2e874f30ac4d43ddef 1398239523';

        $hash = $disqus->getSingleSignOnHash($user, self::TIMESTAMP);

        $this->assertEquals($expected_hash, $hash);
    }


    /**
     * @test
     */
    public function itDoesNotGenerateAHashIfNoUserIsProvided()
    {
        $user = null;
        $disqus = new Disqus('my_web', self::PRIVATE_KEY, self::API_KEY);
        $expected_hash = '';

        $hash = $disqus->getSingleSignOnHash($user, self::TIMESTAMP);

        $this->assertEquals($expected_hash, $hash);
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
