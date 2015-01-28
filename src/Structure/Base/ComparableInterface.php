<?php

namespace Structure\Base;

/**
 * Interface implemented by all comparable objects.
 */
interface ComparableInterface
{
    /**
     * Compares this object with the given object.
     *
     * @param object ComparableInterface $object The given object.
     * @return integer A number less than zero if this object is less than the given object,
     *     zero if this object equals the given object, and a number greater than zero
     *     if this object is greater than the given object.
     */
    public function compare(ComparableInterface $object);

    /**
     * Compares this object with the given object.
     *
     * @param object ComparableInterface $object The given object.
     * @return boolean True if this object is equal to the given object.
     */
    public function eq(ComparableInterface $object);

    /**
     * Compares this object with the given object.
     *
     * @param object ComparableInterface $object The given object.
     * @return boolean True if this object is not equal to the given object.
     */
    public function ne(ComparableInterface $object);

    /**
     * Compares this object with the given object.
     *
     * @param object ComparableInterface $object The given object.
     * @return boolean True if this object is less than the given object.
     */
    public function lt(ComparableInterface $object);

    /**
     * Compares this object with the given object.
     *
     * @param object ComparableInterface $object The given object.
     * @return boolean True if this object is less than or equal to the given object.
     */
    public function le(ComparableInterface $object);

    /**
     * Compares this object with the given object.
     *
     * @param object ComparableInterface $object The given object.
     * @return boolean True if this object is greater than the given object.
     */
    public function gt(ComparableInterface $object);

    /**
     * Compares this object with the given object.
     *
     * @param object ComparableInterface $object The given object.
     * @return boolean True if this object is greater than or equal to the given object.
     */
    public function ge(ComparableInterface $object);
}
