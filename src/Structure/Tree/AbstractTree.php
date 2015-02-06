<?php

namespace Structure\Tree;

use Structure\Base\AbstractContainer;

/**
 * Abstract base class from which all tree classes are derived.
 *
 * @package Opus11
 */
abstract class AbstractTree extends AbstractContainer implements TreeInterface
{
    /**
     * Constructor.
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
     * Causes a visitor to visit the nodes of this tree
     * in depth-first traversal order starting from this node.
     * This method invokes the preVisit
     * and postVisit methods of the visitor
     * for each node in this tree.
     * The default implementation is recursive.
     * The default implementation never invokes the InVisit method
     * of the visitor.
     * The traversal continues as long as the isDone
     * method of the visitor returns false.
     *
     * @param object IPrePostVisitor $visitor The visitor to accept.
     */
    public function depthFirstTraversal(IPrePostVisitor $visitor)
    {
        if ($visitor->isDone())
            return;
        if (!$this->isEmpty())
        {
            $visitor->preVisit($this->getKey());
            for ($i = 0; $i < $this->getDegree(); ++$i)
                $this->getSubtree($i)->depthFirstTraversal(
                    $visitor);
            $visitor->postVisit($this->getKey());
        }
    }

    /**
     * Causes a visitor to visit the nodes of this tree
     * in breadth-first traversal order starting from this node.
     * This method invokes the visit method of the visitor
     * for each node in this tree.
     * The default implementation is iterative and uses a queue
     * to keep track of the nodes to be visited.
     * The traversal continues as long as the isDone
     * method of the visitor returns false.
     *
     * @param object IVisitor $visitor The visitor to accept.
     */
    public function breadthFirstTraversal(IVisitor $visitor)
    {
        $queue = new QueueAsLinkedList();
        if (!$this->isEmpty())
            $queue->enqueue($this);
        while (!$queue->isEmpty() && !$visitor->isDone())
        {
            $head = $queue->dequeue();
            $visitor->visit($head->getKey());
            for ($i = 0; $i < $head->getDegree(); ++$i)
            {
                $child = $head->getSubtree($i);
                if (!$child->isEmpty())
                    $queue->enqueue($child);
            }
        }
    }

    /**
     * Accepts a visitor and does a pre-order, depth-first traversal
     * with the visitor.
     *
     * @param object IVisitor $visitor The visitor to accept.
     */
    public function accept(VisitorInterface $visitor)
    {
        $this->depthFirstTraversal(new PreOrder($visitor));
    }

    /**
     * Returns the height in the tree of this tree node.
     * The height of a node is the length of the longest path from
     * the node to a leaf.
     * The height of an external node is -1.
     *
     * @return integer The height of this tree node.
     */
    public function getHeight()
    {
        if ($this->isEmpty())
            return -1;
        $max = -1;
        for ($i = 0; $i < $this->getDegree(); ++$i)
            $max = max($max, $this->getSubtree($i)->getHeight());
        return $max + 1;
    }

    /**
     * Returns the number of internal nodes in this tree.
     *
     * @return integer The number of internal nodes in this tree.
     */
    public function getCount()
    {
        if ($this->isEmpty())
            return 0;
        $result = 1;
        for ($i = 0; $i < $this->getDegree(); ++$i)
            $result += $this->getSubtree($i)->getCount();
        return $result;
    }

    /**
     * Returns an iterator that enumerates the nodes of this tree.
     *
     * @return object Iterator An iterator.
     */
    public function getIterator()
    {
        return new AbstractTree_Iterator($this);
    }
}
