<?php

class QueueTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        //$this->test = 'test';
    }

    public function tearDown()
    {
        //unset($this->test);
    }

    public function testQueueAsArray()
    {
        $queue = new \Structure\Linear\QueueAsArray(5);
        $this->queueBase($queue);
    }

    public function testDequeAsArray()
    {
        $deque = new Structure\Linear\DequeAsArray(10);
        $this->queueBase($deque);
    }

    protected function queueBase($queue)
    {
        for ($i = 0; $i < 5; ++$i) {
            if ($queue->isFull()) {
                break;
            }
            $queue->enqueue(box($i));
        }
        printf("%s\n", str($queue));

        printf("Using reduce\n");
        $queue->reduce(create_function(
            '$sum,$obj', 'printf("%s\n", str($obj));'), '');

        printf("Using foreach\n");
        foreach ($queue as $obj) {
            printf("%s\n", str($obj));
        }
        printf("getHead\n");
        printf("%s\n", str($queue->getHead()));

        printf("Dequeueing\n");
        while (!$queue->isEmpty()) {
            printf("%s\n", str($queue->dequeue()));
        }
    }

}

