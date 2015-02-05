<?php

namespace Structure\Util;

use Structure\Base\AbstractComparable;
use Structure\Base\ComparableInterface;

/**
 * Represents a boolean value.
 */
class BoxedBoolean extends Box
{
    /**
     * Constructs a BoxedBoolean with the given boolean value.
     *
     * @param boolean $value A boolean value.
     */
    public function __construct($value)
    {
        parent::__construct($value ? true : false);
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
     * @param value A value.
     */
    public function setValue($value)
    {
        $this->value = $value ? true : false;
    }

    /**
     * Compares this BoxedBoolean with the given object.
     * This given object must be a BoxedBoolean.
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
        return ($this->value ? 1 : 0) - ($obj->value ? 1 : 0);
    }

    /**
     * Returns a textual representation of this BoxedBoolean.
     *
     * @return string A string.
     */
    public function __toString()
    {
        return str($this->value);
    }

    /**
     * Returns a hash of the value of this BoxedBoolean.
     *
     * @return integer An integer.
     */
    public function getHashCodebak()
    {
        return $this->value ? 1 : 0;
    }
}
