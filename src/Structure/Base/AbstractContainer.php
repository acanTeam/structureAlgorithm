<?php

namespace Structure\Base;

/**
 * Abstract base class from which all container classes are derived.
 */
abstract class AbstractContainer extends AbstractComparable implements ContainerInterface
{
    /**
     * @var integer The number of items in this container.
     */
    protected $count;

    /**
     * Constructs an AbstractContainer.
     */
    public function __construct()
    {
        parent::__construct();
        $count = 0;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Purge method.
     */
    public function purge()
    {
        $this->count = 0;
    }

    /**
     * Count getter.
     *
     * @return integer The number of items in this container.
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * IsEmpty predicate.
     *
     * @return boolean True if this container is empty.
     */
    public function isEmpty()
    {
        return $this->getCount() == 0;
    }

    /**
     * IsFull predicate.
     *
     * @return boolean True if this container is full.
     */
    public function isFull()
    {
        return false;
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
        foreach ($this as $obj)
        {
            $state = $callback($state, $obj);
        }
        return $state;
    }

    /**
     * Calls the visit method of the given visitor for each object 
     * in this container.
     *
     * @param object VisitorInterface $visitor A visitor.
     */
    public function accept(VisitorInterface $visitor)
    {
        foreach ($this as $obj) {
            if ($visitor->isDone()) {
                break;
            }
            $visitor->visit($obj);
        }
    }

    /**
     * Returns a textual representation of this container.
     *
     * @return string A string.
     */
    public function __toString()
    {
        $s = $this->reduce(
            create_function(
                '$s, $item', 
                'return array($s[0] . $s[1] . str($item), ", ");'
            ), array('',''));
        return $this->getClass()->getName() .  '{' . $s[0] . '}';
    }
    
    /**
     * Returns a hash code for this container.
     *
     * @return integer A hash code. 
     */
    public function getHashCode()
    {
        $s = $this->reduce(
            create_function(
                '$s, $obj',
                'return $s + $obj->getHashCode();'
            ), 0);
        return $s;
    }
}
