<?php

namespace Structure\Orderlist;

use Structure\Util\BasicArray;

/**
 * Represents an ordered list implemented using an array.
 */
class OrderedListAsArray extends AbstractOrderedList
{
    /**
     * @var object BasicArray The array.
     */
    protected $array = null;

    /**
     * Constructs a OrderedListAsArray with the given size.
     *
     * @param integer size The size of this list.
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
     * @return object BasicArray A reference to the array of this list.
     */
    public function & getArray()
    {
        return $this->array;
    }

    /**
     * Count setter.
     *
     * @param integer $count The new count value.
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * Inserts the specified object into this ordered list.
     * @param object IObject $obj The object to insert.
     */
    public function insert(ComparableInterface $obj)
    {
        if ($this->count == $this->array->getLength()) {
            throw new \Structure\Exception\ContainerFullException();
        }

        $this->array[$this->count] = $obj;
        ++$this->count;
    }

    /**
     * Purges this ordered list, making it empty.
     */
    public function purge()
    {
        while ($this->count > 0) {
            $this->array[--$this->count] = null;
        }
    }

    /**
     * Tests whether this ordered list is full.
     *
     * @return boolean True if this ordered list if full; false otherwise.
     */
    public function isFull()
    {
        return $this->count == $this->array->getLength();
    }

    /**
     * Tests whether the specified object is in this ordered list.
     *
     * @param object IObject $obj The object for which to look.
     * @return boolean True if the specified object is in this list;
     * false otherwise.
     */
    public function contains(ComparableInterface $obj)
    {
        for ($i = 0; $i < $this->count; ++$i)
            if ($this->array[$i] === $obj)
                return true;
        return false;
    }

    /**
     * Finds an object in this ordered list that matches the specified object.
     *
     * @param object IObject $obj The object to match.
     * @return mixed
     * The object in this list that matches the specified object;
     * null if no match is found.
     */
    public function find(ComparableInterface $obj)
    {
        for ($i = 0; $i < $this->count; ++$i)
            if (eq($this->array[$i], $obj))
                return $this->array[$i];
        return null;
    }

//{
    /**
     * Withdraws the given object from this ordered list.
     *
     * @param object IObject $obj The object to be withdrawn.
     */
    public function withdraw(ComparableInterface $obj)
    {
        if ($this->count == 0)
            throw new ContainerEmptyException();
        $i = 0;
        while ($i < $this->count && $this->array[$i] !== $obj)
            ++$i;
        if ($i == $this->count)
            throw new ArgumentError();
        for ( ; $i < $this->count - 1; ++$i)
            $this->array[$i] = $this->array[$i + 1];
        $this->array[$i] = null;
        $this->count -= 1;
    }
//}>d

//{
    /**
     * Returns the position of an object in this ordered list
     * that matches the specified object.
     *
     * @param object IObject $obj The object to match.
     * @return object ICursor The position in this list of the matching object.
     */
    public function findPosition(ComparableInterface $obj)
    {
        $i = 0;
        while ($i < $this->count &&
            !eq($this->array[$i], $obj))
            ++$i;
        return new OrderedListAsArray_Cursor($this, $i);
    }

    /**
     * Returns true if the given offset exists.
     *
     * @param integer $offset An offset.
     */
    public function offsetExists($offset)
    {
        return $offset >= 0 && $offset < $this->count;
    }

    /**
     * Returns the object in this ordered lists
     * found at the specified offset.
     *
     * @param integer $offset The offset of the desired object.
     * @return object ComparableInterface The object at the specified offset.
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset))
            throw new IndexError();
        return $this->array[$offset];
    }
//}>e

    public function offsetSet($offset, $value)
    {
        throw new MethodNotImplementedException();
    }

    public function offsetUnset($offset)
    {
        throw new MethodNotImplementedException();
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
        for ($i = 0; $i < $this->count; ++$i)
        {
            $state = $callback($state, $this->array[$i]);
        }
        return $state;
    }

    /**
     * Returns an iterator that enumerates the objects in this list.
     *
     * @return object Iterator An iterator.
     */
    public function getIterator()
    {
        return new OrderedListAsArrayCursor($this);
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
        throw new \Structure\Exception\MethodNotImplementedException();
    }
    
    /**
     * Main program.
     *
     * @param array $args Command-line arguments.
     * @return integer Zero on success; non-zero on failure.
     */
    public static function main($args)
    {
        printf("OrderedListAsArray main program.\n");
        $status = 0;
        $list = new OrderedListAsArray(5);
        AbstractOrderedList::test($list);
        return $status;
    }
}
