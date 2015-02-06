<?php

namespace Structure\Linear;

use Structure\Base\ContainerInterface;
use Structure\Base\ObjectInterface;

/**
 * Interface implemented by all deques.
 */
interface DequeInterface extends ContainerInterface, QueueInterface
{
    /**
     * Enqueues the given object at the head of this deque.
     *
     * @param object ObjectInterface $obj The object to enqueue.
     */
    public function enqueueHead(ObjectInterface $obj);

    /**
     * Enqueues the given object at the tail of this deque.
     *
     * @param object ObjectInterface $obj The object to enqueue.
     */
    public function enqueueTail(ObjectInterface $obj);

    /**
     * Dequeues and returns the object at the head of this deque.
     *
     * @return object ObjectInterface The object at the head of this deque.
     */
    public function dequeueHead();

    /**
     * Dequeues and returns the object at the tail of this deque.
     *
     * @return object ObjectInterface The object at the tail of this deque.
     */
    public function dequeueTail();

    /**
     * Tail getter.
     *
     * @return object ObjectInterface The object at the tail of this deque.
     */
    public function getTail();
}
