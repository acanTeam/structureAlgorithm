<?php

namespace Structure\Linear;

use Structure\Util\BasicArray;
use Structure\Base\ComparableInterface;
use Structure\Base\ObjectInterface;

/**
 * Represents a queue implemented using an array.
 */
class QueueAsArray extends AbstractQueue
{
    /**
     * @var object BasicArray The array.
     */
    protected $array = null;

    /**
     * @var integer The position of the head of the queue.
     */
    protected $head = 0;

    /**
     * @var integer The position of the tail of the queue.
     */
    protected $tail = 0;

    /**
     * Constructs a QueueAsArray with the given size.
     *
     * @param integer $size The size of this queue.
     */
    public function __construct($size = 0)
    {
        parent::__construct();
        $this->array = new BasicArray($size);
        $this->head = 0;
        $this->tail = $size - 1;
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
     * @return object BasicArray A reference to the array of this queue.
     */
    public function & getArray()
    {
        return $this->array;
    }

    /**
     * Head position getter.
     */
    public function getHeadPosition()
    {
        return $this->head;
    }

    /**
     * Tail position getter.
     */
    public function getTailPosition()
    {
        return $this->tail;
    }

    /**
     * Purges this queue.
     */
    public function purge()
    {
        while ($this->count > 0) {
            $this->array[$this->head] = null;
            if (++$this->head == $this->array->getLength()) {
                $this->head = 0;
            }
            $this->count -= 1;
        }
    }

    /**
     * Enqueues the given object at the tail of this queue.
     *
     * @param object ObjectInterface $obj The object to enqueue.
     */
    public function enqueue(ObjectInterface $obj)
    {
        if ($this->count == $this->array->getLength()) {
            throw new \Structure\Exception\ContainerFullException();
        }

        if (++$this->tail == $this->array->getLength()) {
            $this->tail = 0;
        }
        $this->array[$this->tail] = $obj;
        $this->count += 1;
    }

    /**
     * Dequeues and returns the object at the head of this queue.
     *
     * @return object ObjectInterface The object at the head of this queue.
     */
    public function dequeue()
    {
        if ($this->count == 0) {
            throw new \Structure\Exception\ContainerEmptyException();
        }

        $result = $this->array[$this->head];
        $this->array[$this->head] = null;
        if (++$this->head == $this->array->getLength())
            $this->head = 0;
        $this->count -= 1;
        return $result;
    }

    /**
     * Head getter.
     *
     * @return object ObjectInterface The object at the head of this queue.
     */
    public function getHead()
    {
        if ($this->count == 0) {
            throw new \Structure\Exception\ContainerEmptyException();
        }

        return $this->array[$this->head];
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
        $pos = $this->head;
        $state = $initialState;
        for ($i = 0; $i < $this->count; ++$i) {
            $state = $callback($state, $this->array[$pos]);
            if (++$pos == $this->array->getLength()) {
                $pos = 0;
            }
        }
        return $state;
    }

    /**
     * Returns an iterator that enumerates the objects in this queue.
     *
     * @return object Iterator An iterator.
     */
    public function getIterator()
    {
        return new QueueAsArrayIterator($this);
    }

    /**
     * IsFull predicate.
     *
     * @return boolean True if this queue is full.
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
