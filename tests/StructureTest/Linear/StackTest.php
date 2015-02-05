<?php

class StackTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        //$this->test = 'test';
    }

    public function tearDown()
    {
        //unset($this->test);
    }

    public function testStackAsLinkedList()
    {
        $stack = new Structure\Linear\StackAsLinkedList();

        Structure\Linear\AbstractStack::test($stack);
    }
}

