<?php

namespace Structure\Linear;

use Structure\Base\ObjectInterface;

/**
 * Represents a deque implemented using a linked list.
 */
class DequeAsLinkedList extends QueueAsLinkedList implements DequeInterface
{
    /**
     * Constructs a DequeAsLinkedList.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Enqueues the given object at the head of this deque.
     *
     * @param object IObject $obj The object to enqueue.
     */
    public function enqueueHead(ObjectInterface $obj)
    {
        $this->list->prepend($obj);
        $this->count += 1;
    }

    /**
     * Dequeues and returns the object at the head of this deque.
     *
     * @return object IObject The object at the head of this deque.
     */
    public function dequeueHead()
    {
        return $this->dequeue();
    }

    /**
     * Enqueues the given object at the tail of this deque.
     *
     * @param object IObject $obj The object to enqueue.
     */
    public function enqueueTail(ObjectInterface $obj)
    {
        $this->enqueue($obj);
    }

    /**
     * Dequeues and returns the object at the tail of this deque.
     *
     * @return object IObject The object at the tail of this deque.
     */
    public function dequeueTail()
    {
        if ($this->count == 0) {
            throw new \Structure\Exception\ContainerEmptyException();
        }

        $result = $this->list->getLast();
        $this->list->extract($result);
        $this->count -= 1;
        return $result;
    }

    /**
     * Tail getter.
     *
     * @return object IObject The object at the tail of this deque.
     */
    public function getTail()
    {
        if ($this->count == 0) {
            throw new \Structure\Exception\ContainerEmptyException();
        }

        return $this->list->getLast();
    }
}
