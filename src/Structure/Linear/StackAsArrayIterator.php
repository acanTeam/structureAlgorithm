<?php

namespace Structure\Linear;

use Structure\Base\BasicArray;
use Structure\Base\AbstractIterator;

/**
 * An iterator that enumerates the items in a StackAsArray.
 */
class StackAsArrayIterator extends AbstractIterator
{
    /**
     * @var object StackAsArray The stack to enumerate.
     */
    protected $stack = null;

    /**
     * @var integer The current position.
     */
    protected $position = 0;

    /**
     * Constructs a StackAsArray_Iterator for the given stack.
     *
     * @param object StackAsArray $stack A stack.
     */
    public function __construct(StackAsArray $stack)
    {
        parent::__construct();
        $this->stack = $stack;
        $this->position = 0;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $this->stack = null;
        parent::__destruct();
    }

    /**
     * Valid predicate.
     *
     * @return boolean True if the current position of this iterator is valid.
     */
    public function valid()
    { 
        return $this->position < $this->stack->getCount();
    }

    /**
     * Key getter.
     *
     * @return integer The key for the current position of this iterator.
     */
    public function key()
    { 
        return $this->position;
    }

    /**
     * Current getter.
     *
     * @return mixed The value for the current postion of this iterator.
     */
    public function current()
    {
        $array = $this->stack->getArray();
        return $array[$this->position];
    }

    /**
     * Advances this iterator to the next position.
     */
    public function next()
    {
        $this->position += 1;
    }

    /**
     * Rewinds this iterator to the first position.
     */
    public function rewind()
    {
        $this->position = 0;
    }
}
