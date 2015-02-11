<?php

namespace Structure\Util\Boxed;

use Structure\Base\AbstractComparable;
use Structure\Base\ComparableInterface;

/**
 * Abstract base class from which all boxed value classes are derived.
 */
abstract class Box extends AbstractComparable
{
    /**
     * $var mixed The boxed value.
     */
    protected $value = null;

    /**
     * Constructs a Box with the given value.
     *
     * @param mixed $value A value.
     */
    public function __construct($value)
    {
        parent::__construct();

        $this->value = $value;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Value getter.
     *
     * @return mixed Return the value of this box.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns a textual representation of the value in this box.
     *
     * @return string A string.
     */
    public function __toString()
    {
        return strval($this->value);
    }
}

