<?php

namespace Structure\Base;

/**
 * Interface implemented by all containers.
 */
interface ContainerInterface extends ComparableInterface, \IteratorAggregate
{
    /**
     * Count getter.
     *
     * @return integer The number of items in this container.
     */
    public function getCount();

    /**
     * IsEmpty predicate.
     *
     * @return boolean True if this container is empty.
     */
    public function isEmpty();

    /**
     * IsFull predicate.
     *
     * @return boolean True if this container is full.
     */
    public function isFull();

    /**
     * Purges this container.
     */
    public function purge();

    /**
     * Returns a value computed by calling the given callback function for each 
     * item in this container. Each time the callback function will be called 
     * with two arguments: The first argument is the next item in this container.
     * The first time the callback function is called, the second argument is 
     * the given initial value. On subsequent calls to the callback function,
     * the second argument is the result returned from the previous call to the callback function.
     *
     * @param callback $callback A callback function.
     * @param mixed $initialState The initial value.
     * @return mixed The value returned by the last call to the callback function.
     */
    public function reduce($callback, $initialState);

    /**
     * Calls the visit method of the given visitor for each item in this container.
     *
     * @param object IVisitor $visitor A visitor.
     */
    public function accept(VisitorInterface $visitor);
}
