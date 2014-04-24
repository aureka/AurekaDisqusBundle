<?php

namespace Aureka\DisqusBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Aureka\DisqusBundle\Tests\Application\AppKernel;
use Aureka\DisqusBundle\Tests\Fixture\MyDisqusable;

class Mocker
{
    private $testCase;


    public function __construct(\PHPUnit_Framework_TestCase $test_case)
    {
        $this->testCase = $test_case;
    }


    public function aDoubleOf($class_name, array $stubs = array()) {
        $double = $this->testCase->getMockBuilder($class_name)
            ->disableOriginalConstructor()
            ->getMock();

        foreach ($stubs as $method => $return_value) {
            $double->expects($this->testCase->any())
                ->method($method)
                ->will($this->testCase->returnValue($return_value));
        }

        return $double;
    }
}
