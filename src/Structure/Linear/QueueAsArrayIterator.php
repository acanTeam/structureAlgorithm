<?php

namespace Structure\Linear;

use Structure\Util\BasicArray;
use Structure\Base\AbstractIterator;

/**
 * An iterator that enumerates the items in a QueueAsArray.
 */
class QueueAsArrayIterator extends AbstractIterator
{
    /**
     * @var object QueueAsArray The queue to enumerate.
     */
    protected $queue = null;

    /**
     * @var integer The current position.
     */
    protected $position = 0;

    /**
     * @var integer The number of objects enuemrated.
     */
    protected $count = 0;

    /**
     * Constructs a QueueAsArray_Iterator for the given queue.
     *
     * @param object QueueAsArray $queue A queue.
     */
    public function __construct(QueueAsArray $queue)
    {
        parent::__construct();
        $this->queue = $queue;
        $this->position = $this->queue->getHeadPosition();
        $this->count = 0;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $this->queue = null;
        parent::__destruct();
    }

    /**
     * Valid predicate.
     *
     * @return boolean True if the current position of this iterator is valid.
     */
    public function valid()
    { 
        return $this->count < $this->queue->getCount();
    }

    /**
     * Key getter.
     *
     * @return integer The key for the current position of this iterator.
     */
    public function key()
    {
        return $this->count;
    }

    /**
     * Current getter.
     *
     * @return mixed The value for the current postion of this iterator.
     */
    public function current()
    {
        $array = $this->queue->getArray();
        return $array[$this->position];
    }

    /**
     * Advances this iterator to the next position.
     */
    public function next() {
        if (++$this->position ==
            $this->queue->getArray()->getLength())
            $this->position = 0;
        $this->count += 1;
    }

    /**
     * Rewinds this iterator to the first position.
     */
    public function rewind()
    {
        $this->position = $this->queue->getHeadPosition();
        $this->count = 0;
    }
}
