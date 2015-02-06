<?php

namespace Structure\Tree;

use Structure\Base\ObjectInterface;
use Structure\Linear\LinkedList;

/**
 * Represents a node in a general tree.
 */
class GeneralTree extends AbstractTree
{
    /**
     * @var object ObjectInterface The key in this node.
     */
    protected $key = null;

    /**
     * @var integer The degree of this node.
     */
    protected $degree = 0;

    /**
     * @var object LinkedList A linked list of the subtrees of this node.
     */
    protected $list = null;

    /**
     * Constructs a GeneralTree with the specified key.
     *
     * @param object ObjectInterface $key The desired key.
     */
    public function __construct(ObjectInterface $key)
    {
        parent::__construct();
        $this->key = $key;
        $this->degree = 0;
        $this->list = new LinkedList();
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $this->key = null;
        $this->list = null;
        parent::__destruct();
    }

    /**
     * Purges this general tree node, making it empty.
     */
    public function purge()
    {
        $this->list->purge();
        $this->degree = 0;
    }

    /**
     * Tests whether this general tree node is empty.
     *
     * @return boolean False always.
     */
    public function isEmpty()
    {
        return false;
    }

    /**
     * Tests whether this general tree nodes is a leaf node.
     *
     * @return boolean True if the degree of this node is zero;
     * false otherwise.
     */
    public function isLeaf()
    {
        return $this->degree == 0;
    }

    /**
     * Degree getter.
     *
     * @return integer The degree of this node.
     */
    public function getDegree ()
    {
        return $this->degree;
    }

    /**
     * Key getter.
     *
     * @return object ObjectInterface The key of this general tree node.
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Returns the specified subtree of this general tree node.
     *
     * @return object GeneralTree The desired subtree of this tree node.
     */
    public function getSubtree($i)
    {
        if ($i < 0 || $i >= $this->degree)
            throw new IndexError();
        $ptr = $this->list->getHead();
        for ($j = 0; $j < $i; ++$j)
            $ptr = $ptr->getNext();
        return $ptr->getDatum();
    }

    /**
     * Attaches the specified subtree to this general tree node.
     *
     * @param object GeneralTree $t The subtree to attach.
     */
    public function attachSubtree(GeneralTree $t)
    {
        $this->list->append($t);
        ++$this->degree;
    }

    /**
     * Detaches and returns the specified subtree of this general tree node.
     *
     * @param object GeneralTree $t The subtree to detach.
     */
    public function detachSubtree(GeneralTree $t)
    {
        $this->list->extract($t);
        --$this->degree;
        return $t;
    }

    /**
     * Compares this general tree with the specified comparable object.
     * This method is not implemented.
     *
     * @param object ComaprableInterface $arg
     * The comparable object with which to compare this tree.
     **/
    protected function compareTo(ComaprableInterface $arg)
    {
        throw new MethodNotImplementedException();
    }
}
