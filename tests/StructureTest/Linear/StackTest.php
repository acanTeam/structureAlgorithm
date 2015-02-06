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

    public function testStackAsArray()
    {
        $stack = new Structure\Linear\StackAsArray(5);
        $this->stackBase($stack);
    }
    
    protected function stackBase($stack)
    {
        printf("AbstractStack test program.\n");

        for ($i = 0; $i < 6; ++$i)
        {
            if ($stack->isFull())
                break;
            $stack->push(box($i));
        }
        printf("%s\n", str($stack));

        printf("Using foreach\n");
        foreach ($stack as $obj)
        {
            printf("%s\n", str($obj));
        }

        printf("Using reduce\n");
        $stack->reduce(create_function(
            '$sum,$obj', 'printf("%s\n", str($obj));'), '');

        printf("Top is %s\n", str($stack->getTop()));

        printf("Popping\n");
        while (!$stack->isEmpty())
        {
            $obj = $stack->pop();
            printf("%s\n", str($obj));
        }

        $stack->push(box(2));
        $stack->push(box(4));
        $stack->push(box(6));
        printf("%s\n", str($stack));
        printf("Purging\n");
        $stack->purge();
        printf("%s\n", str($stack));
    }
}

