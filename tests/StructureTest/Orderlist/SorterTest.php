<?php

use Structure\Util\RandomNumberGenerator;
use Structure\Util\BasicArray;
use Structure\Util\Limits;
use Structure\Util\Timer;

class SorterTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        //$this->test = 'test';
    }

    public function tearDown()
    {
        //unset($this->test);
    }

    public function testBubbleSorter()
    {
        $sorter = new \Structure\Orderlist\BubbleSorter();
        $this->sorter($sorter, 100, 123);
    }

    private function sorter($sorter, $n, $seed, $m = 0)
    {
        RandomNumberGenerator::setSeed($seed);
        $data = new BasicArray($n);
        for ($i = 0; $i < $n; ++$i)
        {
            $datum = intval(RandomNumberGenerator::next() * Limits::MAXINT);
            if ($m != 0)
            {
                $datum = $datum % $m;
            }
            $data[$i] = $datum;
        }
        $timer = new Timer();
        $timer->start();
        $sorter->sort($data);
        $timer->stop();
        $datum = sprintf("%s %d %d %f", $sorter->getClass()->getName(),
            $n, $seed, $timer->getElapsedTime());
        fprintf(STDOUT, "%s\n", $datum);
        fprintf(STDERR, "%s\n", $datum);
        for ($i = 1; $i < $n; ++$i)
        {
            if ($data[$i] < $data[$i - 1])
            {
                printf("FAILED\n");
                break;
            }
        }
    }
}

