<?php

namespace Structure\Linear;

use Structure\Base\AbstractIterator;

/**
 * An iterator that enumerates the items in a StackAsLinkedList.
 */
class StackAsLinkedListIterator extends AbstractIterator
{
    /**
     * @var object StackAsLinkedList The stack to enumerate.
     */
    protected $stack = null;

    /**
     * @var object LinkedListElement The current position.
     */
    protected $position = null;

    /**
     * @var integer The key for the current position.
     */
    protected $key = 0;

    /**
     * Constructs a StackAsLinkedListIterator for the given stack.
     *
     * @param object StackAsLinkedList $stack A stack.
     */
    public function __construct(StackAsLinkedList $stack)
    {
        parent::__construct();
        $this->stack = $stack;
        $this->position = $stack->getList()->getHead();
        $this->key = 0;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $this->stack = null;
        $this->position = null;
        parent::__destruct();
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
        $this->position = $this->stack->getList()->getHead();
        $this->key = 0;
    }
}
