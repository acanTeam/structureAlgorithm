<?php

namespace Structure\Linear;

use Structure\Base\ContainerInterface;
use Structure\Base\ObjectInterface;

/**
 * Interface implemented by all queues.
 */
interface QueueInterface extends ContainerInterface
{
    /**
     * Enqueues the given object at the tail of this queue.
     *
     * @param object ObjectInterface $obj The object to enqueue.
     */
    public function enqueue(ObjectInterface $obj);

    /**
     * Dequeues and returns the object at the head of this queue.
     *
     * @return object ObjectInterface The object at the head of this queue.
     */
    public function dequeue();

    /**
     * Head getter.
     *
     * @return object ObjectInterface The object at the head of this queue.
     */
    public function getHead();
}
