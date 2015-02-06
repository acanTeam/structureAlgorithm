<?php

class TimerTest extends PHPUnit_Framework_TestCase
{
    //private $basicArrayObject = null;

    public function setUp()
    {
    }

    public function tearDown()
    {
    }

    public function testTimer()
    {
        $timer = new \Structure\Util\Timer();
        $timer->start();
        $x = 2;
        for ($i = 0; $i < 10000000; ++$i) {
            $x = $x * 2;
        }
        $timer->stop();
        printf("Elapsed time %f\n", $timer->getElapsedTime());
    }
}

