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
        $start = $timer->start();
        $x = 2;
        for ($i = 0; $i < 10000000; ++$i) {
            $x = $x * 2;
        }

        $stop = $timer->stop();
        $this->assertEquals($stop - $start, $timer->getElapsedTime());
        //printf("Elapsed time %f\n", $timer->getElapsedTime());
    }
}

