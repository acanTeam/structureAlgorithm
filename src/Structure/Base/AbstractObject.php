<?php

namespace Structure\Base;

use Straucture\Interface\ObjectInterface;

/**
 * Abstract base class from which all object classes are derived.
 */
abstract class AbstractObject implements ObjectInterface
{
    /**
     * Constructs an AbstractObject.
     */
    public function __construct()
    {}

    /**
     * Destructor.
     */
    public function __destruct()
    {}

    /**
     * Returns a unique identifier for this object.
     *
     * @return integer An identifier.
     */
    public function getId()
    {
        return $this->getHashCode();
    }

    /**
     * Returns the class of this object.
     *
     * @return object ReflectionClass A ReflectionClass.
     */
    public function getClass()
    {
        return new \ReflectionClass(get_class($this));
    }

    /**
     * Returns a hash code for this object.
     *
     * @return integer A hash code.
     */
    public function getHashCode()
    {
        return spl_object_hash($this);
    }

    /**
     * Returns a textual representation of this object.
     *
     * @return string A string.
     */
    public function __toString()
    {
        return $this->getClass()->getName() . '{' . strval($this) . '}';
    }
}
