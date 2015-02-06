<?php

namespace Structure\Linear;

use Structure\Base\AbstractIterator;

/**
 * An iterator that enumerates the items in a QueueAsLinkedList.
 */
class QueueAsLinkedListIterator extends AbstractIterator
{
    /**
     * @var object QueueAsLinkedList The queue to enumerate.
     */
    protected $queue = null;

    /**
     * @var object LinkedList_Element The current position.
     */
    protected $position = null;

    /**
     * @var integer The key for the current position.
     */
    protected $key = 0;

    /**
     * Constructs a QueueAsLinkedList_Iterator for the given queue.
     *
     * @param object QueueAsLinkedList $queue A queue.
     */
    public function __construct(QueueAsLinkedList $queue)
    {
        parent::__construct();
        $this->queue = $queue;
        $this->position = $queue->getList()->getHead();
        $this->key = 0;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
        $this->queue = null;
        $this->position = null;
    }

    /**
     * Valid predicate.
     *
     * @return boolean True if the current position of this iterator is valid.
     */
    public function valid()
    {
        return $this->position !== null;
    }

    /**
     * Key getter.
     *
     * @return integer The key at the current position of this iterator.
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Current getter.
     *
     * @return mixed The value at the current position of this iterator.
     */
    public function current()
    {
        return $this->position->getDatum();
    }

    /**
     * Advances this iterator to the next position.
     */
    public function next()
    {
        $this->position = $this->position->getNext();
        $this->key += 1;
    }

    /**
     * Rewinds this iterator to the first position.
     */
    public function rewind()
    {
        $this->position = $this->queue->getList()->getHead();
        $this->key = 0;
    }
}
