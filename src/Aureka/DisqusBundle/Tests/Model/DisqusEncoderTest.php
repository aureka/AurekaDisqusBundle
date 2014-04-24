<?php

namespace Aureka\DisqusBundle\Tests\Twig;

use Aureka\DisqusBundle\Model\DisqusEncoder;


class DisqusEncoderTest extends \PHPUnit_Framework_TestCase
{

    const PRIVATE_KEY = 'EYuDqiVgY7z9viAaD8rZiLyUL73ezB7MTKzbhl15LnkTM5mDkVWaeSfACIZyLw2c';
    const TIMESTAMP   = 1398239523;


    /**
     * @test
     */
    public function itGeneratesASingleSignOnHash()
    {
        $data = array(
                'id' => 56,
                'username' => 'someone',
                'email' => 'someones@email.is'
                );
        $expected_hash = 'eyJpZCI6NTYsInVzZXJuYW1lIjoic29tZW9uZSIsImVtYWlsIjoic29tZW9uZXNAZW1haWwuaXMifQ== 71ac24d3f28450adad62de2e874f30ac4d43ddef 1398239523';

        $hash = DisqusEncoder::generate($data, self::PRIVATE_KEY, self::TIMESTAMP);

        $this->assertEquals($expected_hash, $hash);
    }

}