<?php

namespace Structure\Linear;

use Structure\Base\ObjectInterface;

/**
 * Represents a deque implemented using an array.
 */
class DequeAsArray extends QueueAsArray implements DequeInterface
{
    /**
     * Constructs a DequeAsArray with the given size.
     *
     * @param integer $size The size of this deque.
     */
    public function __construct($size = 0)
    {
        parent::__construct($size);
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
     * @param object ObjectInterface $obj The object to enqueue.
     */
    public function enqueueHead(ObjectInterface $obj)
    {
        if ($this->count == $this->array->getLength())
            throw new ContainerFullException();
        if (--$this->head < 0)
            $this->head = $this->array->getLength() - 1;
        $this->array[$this->head] = $obj;
        $this->count += 1;
    }

    /**
     * Dequeues and returns the object at the head of this deque.
     *
     * @return object ObjectInterface The object at the head of this deque.
     */
    public function dequeueHead()
    {
        return $this->dequeue();
    }

    /**
     * Enqueues the given object at the tail of this deque.
     *
     * @param object ObjectInterface $obj The object to enqueue.
     */
    public function enqueueTail(ObjectInterface $obj)
    {
        $this->enqueue($obj);
    }

    /**
     * Dequeues and returns the object at the tail of this deque.
     *
     * @return object ObjectInterface The object at the tail of this deque.
     */
    public function dequeueTail()
    {
        if ($this->count == 0)
            throw new ContainerEmptyException();
        $result = $this->array[$this->tail];
        $this->array[$this->tail] = NULL;
        if (--$this->tail < 0)
            $this->tail = $this->array->getLength() - 1;
        $this->count -= 1;
        return $result;
    }

    /**
     * Tail getter.
     *
     * @return object IOBject The object at the tail of this deque.
     */
    public function getTail()
    {
        if ($this->count == 0)
            throw new ContainerEmptyException();
        return $this->array[$this->tail];
    }
}
