<?php

namespace Structure\Tree;

use Structure\Base\AbstractIterator;
use Structure\Linear\StackAsLinkedList;

/**
 * An iterator that enumerates the items in a AbstractTree.
 */
class AbstractTreeIterator extends AbstractIterator
{
    /**
     * The tree to enumerate.
     */
    protected $tree = null;

    /**
     * Used to keep track of the nodes to be enumerated.
     */
    protected $stack = null;

    /**
     * The current key.
     */
    protected $key = 0;

    /**
     * Constructs a AbstractTree_Iterator for the given stack.
     *
     * @param object AbstractTree $tree The tree to enumerated.
     */
    public function __construct(AbstractTree $tree)
    {
        parent::__construct();
        $this->tree = $tree;
        $this->stack = new StackAsLinkedList();
        if (!$this->tree->isEmpty())
            $this->stack->push($this->tree);
        $this->key = 0;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $this->tree = null;
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
        return !$this->stack->isEmpty();
    }

    /**
     * Key getter.
     *
     * @return integer The key for the current position of this iterator.
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Current getter.
     *
     * @return mixed The value for the current postion of this iterator.
     */
    public function current()
    {
        return $this->stack->getTop()->getKey();
    }

    /**
     * Advances this iterator to the next position.
     */
    public function next()
    {
        $top = $this->stack->pop();
        for ($i = $top->getDegree() - 1; $i >= 0; --$i) {
            $subtree = $top->getSubtree($i);
            if (!$subtree->isEmpty()) {
                $this->stack->push($subtree);
            }
        }
        ++$this->key;
    }

    /**
     * Rewinds this iterator to the first position.
     */
    public function rewind()
    {
        $this->stack = new StackAsLinkedList();
        if (!$this->tree->isEmpty())
            $this->stack->push($this->tree);
        $this->key = 0;
    }
}
