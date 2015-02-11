<?php

namespace Structure\Util\Boxed;

use Structure\Base\AbstractComparable;
use Structure\Base\ComparableInterface;

/**
 * Represents an integer.
 */
class BoxedInteger extends Box
{
    /**
     * Constructs a BoxedInteger with the given value.
     *
     * @param integer $value A value.
     */
    public function __construct($value)
    {
        parent::__construct(intval($value));
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Value setter.
     *
     * @param integer $value A value.
     */
    public function setValue($value)
    {
        $this->value = intval($value);
    }

    /**
     * Compares this object with the given object.
     * This object and the given object are instances of the same class.
     *
     * @param object IComparable $obj The given object.
     * @return integer A number less than zero
     * if this object is less than the given object,
     * zero if this object equals the given object, and
     * a number greater than zero
     * if this object is greater than the given object.
     */
    protected function compareTo(ComparableInterface $obj)
    {
        return $this->value - $obj->value;
    }

    /**
     * Returns a hash of the value of this BoxedInteger.
     *
     * @return integer An integer.
     */
    public function getHashCodebak()
    {
        return $this->value;
    }
}
