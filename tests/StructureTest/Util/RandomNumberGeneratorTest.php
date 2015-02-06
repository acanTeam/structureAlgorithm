<?php

class RandomNumberGeneratorTest extends PHPUnit_Framework_TestCase
{
    //private $basicArrayObject = null;

    public function setUp()
    {
    }

    public function tearDown()
    {
    }

    public function testNumberGenerator()
    {
        \Structure\Util\RandomNumberGenerator::setSeed(1);
        for ($i = 0; $i < 10; ++$i) {
            printf("%.15f\n", \Structure\Util\RandomNumberGenerator::next());
        }
    }
}

