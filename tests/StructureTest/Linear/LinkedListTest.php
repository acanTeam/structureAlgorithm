<?php

class LinkedListTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        //$this->test = 'test';
    }

    public function tearDown()
    {
        //unset($this->test);
    }

    public function testLinkedList()
    {
        $linkedList = new \Structure\Linear\LinkedList();
        $this->linkedListBase($linkedList);
    }

    protected function linkedListBase($linkedList)
    {
        $linkedList->append(57);
        $linkedList->append('hello');
        $linkedList->append(null);
        printf("%s\n", str($linkedList));
        printf("isEmpty returns %s\n", str($linkedList->isEmpty()));
        printf("Using reduce\n");
        $linkedList->reduce(
            create_function('$sum, $item',
                'printf("%s\n", str($item));'), '');
        printf("Purging\n");
        $linkedList->purge();
        printf("%s\n", str($linkedList));
    }
}

