<?php

namespace Structure\Util;

use Structure\Base\AbstractComparable;
use Structure\Base\ComparableInterface;

/**
 * Represents a float value.
 */
class BoxedFloat extends Box
{
    /**
     * Constructs a BoxedFloat with the given value.
     *
     * @param float $value A value.
     */
    public function __construct($value)
    {
        parent::__construct(floatval($value));
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
     * @param float $value A value.
     */
    public function setValue($value)
    {
        $this->value = floatval($value);
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
     * Returns a hash of the value of this BoxedFloat.
     *
     * @return integer An integer.
     */
    public function getHashCodebak()
    {
        $abs = abs($this->value);
        $exponent = intval(log($abs, 2) + 1);
        $mantissa = $abs / pow(2, $exponent);
        $result = intval((2 * $mantissa - 1) * 2147483648);
        return $result;
    }
}
