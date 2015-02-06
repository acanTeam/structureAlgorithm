<?php

namespace Structure\Linear;

use Structure\Base\ComparableInterface;
use Structure\Base\ObjectInterface;

/**
 * Represents a stack implemented using a linked list.
 */
class StackAsLinkedList extends AbstractStack
{
    /**
     * @var object LinkedList The linked list.
     */
    protected $list = null;

    /**
     * Constructs a StackAsLinkedList.
     */
    public function __construct()
    {
        parent::__construct();
        $this->list = new LinkedList();
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $this->list = null;
        parent::__destruct();
    }

    /**
     * List getter.
     *
     * @return object LinkedList The linked list of this stack.
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Purges this stack.
     */
    public function purge()
    {
        $this->list->purge();
        parent::purge();
    }

    /**
     * Pushes the given object on to this stack.
     *
     * @param object ObjectInterface $obj The object to push.
     */
    public function push(ObjectInterface $obj)
    {
        $this->list->prepend($obj);
        $this->count += 1;
    }

    /**
     * Pops and returns the top object on this stack.
     *
     * @return object ObjectInterface The top object on this stack.
     */
    public function pop()
    {
        if ($this->count == 0)
            throw new ContainerEmptyException();
        $result = $this->list->getFirst();
        $this->list->extract($result);
        $this->count -= 1;
        return $result;
    }

    /**
     * Top getter.
     *
     * @return object ObjectInterface The top object on this stack.
     */
    public function getTop()
    {
        if ($this->count == 0)
            throw new ContainerEmptyException();
        return $this->list->getFirst();
    }

    /**
     * Returns a value computed by calling the given callback function
     * for each item in this container.
     * Each time the callback function will be called with two arguments:
     * The first argument is the next item in this container.
     * The first time the callback function is called,
     * the second argument is the given initial value.
     * On subsequent calls to the callback function,
     * the second argument is the result returned from
     * the previous call to the callback function.
     *
     * @param callback $callback A callback function.
     * @param mixed $initialState The initial state.
     * @return mixed The value returned by
     * the last call to the callback function.
     */
    public function reduce($callback, $initialState)
    {
        return $this->list->reduce($callback, $initialState);
    }

    /**
     * Returns an iterator that enumerates the objects in this stack.
     *
     * @return object Iterator An iterator.
     */
    public function getIterator()
    {
        return new StackAsLinkedListIterator($this);
    }

    /**
     * Compares this object with the given object.
     * This object and the given object are instances of the same class.
     *
     * @param object ComparableInterface $obj The given object.
     * @return integer A number less than zero
     * if this object is less than the given object,
     * zero if this object equals the given object, and
     * a number greater than zero
     * if this object is greater than the given object.
     */
    public function compareTo(ComparableInterface $obj)
    {
        throw new MethodNotImplementedException();
    }
}
