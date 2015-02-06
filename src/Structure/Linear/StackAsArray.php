<?php

namespace Structure\Linear;

use Structure\Base\ObjectInterface;
use Structure\Base\ComparableInterface;
use Structure\Util\BasicArray;

/**
 * Represents a stack implemented using an array.
 */
class StackAsArray extends AbstractStack
{
    /**
     * @var object BasicArray The array.
     */
    protected $array = null;

    /**
     * Constructs a StackAsArray with the given size.
     *
     * @param integer $size The size of this stack.
     */
    public function __construct($size = 0)
    {
        parent::__construct();
        $this->array = new BasicArray($size);
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $this->array = null;
        parent::__destruct();
    }

    /**
     * Array getter.
     *
     * @return object BasicArray A reference to the array of this stack.
     */
    public function & getArray()
    {
        return $this->array;
    }

    /**
     * Purges this stack.
     */
    public function purge()
    {
        while ($this->count > 0) {
            $this->count -= 1;
            $this->array[$this->count] = null;
        }
    }

    /**
     * Pushes the given object onto this stack.
     *
     * @param object OjbectInterface $obj The object to push.
     */
    public function push(ObjectInterface $obj)
    {
        if ($this->count == $this->array->getLength()) {
            throw new \Structure\Exception\ContainerFullException();
        }

        $this->array[$this->count] = $obj;
        $this->count += 1;
    }

    /**
     * Pops and returns the top object on this stack.
     *
     * @return object OjbectInterface The top object on this stack.
     */
    public function pop()
    {
        if ($this->count == 0) {
            throw new \Strcuture\Exception\ContainerEmptyException();
        }

        $this->count -= 1;
        $result = $this->array[$this->count];
        $this->array[$this->count] = null;
        return $result;
    }

    /**
     * Top getter.
     *
     * @return object OjbectInterface The top object on this stack.
     */
    public function getTop()
    {
        if ($this->count == 0) {
            throw new \Structure\Exception\ContainerEmptyException();
        }

        return $this->array[$this->count - 1];
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
        $state = $initialState;
        for ($i = 0; $i < $this->count; ++$i) {
            $state = $callback($state, $this->array[$i]);
        }
        return $state;
    }

    /**
     * Returns an iterator that enumerates the objects in this stack.
     *
     * @return object Iterator An iterator.
     */
    public function getIterator()
    {
        return new StackAsArrayIterator($this);
    }

    /**
     * IsFull predicate.
     *
     * @return boolean True if this stack is full.
     */
    public function isFull()
    {
        return $this->count == $this->array->getLength();
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
