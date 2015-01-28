<?php

class TestTest extends PHPUnit_Framework_TestCase
{
    private $test = null;

    public function setUp()
    {
        $this->test = 'test';
        echo $this->test;
    }

    public function tearDown()
    {
        unset($this->test);
    }

    public function testDemo()
    {
        $this->assertEquals('test', $this->test);
    }
}

