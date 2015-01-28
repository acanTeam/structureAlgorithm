<?php

namespace Structure\Base;

use Structure\Exception;

/**
 * Interface implemented by all objects.
 */
interface ObjectInterface
{
    /**
     * Returns a unique identifier for this object.
     *
     * @return integer An identifier.
     */
    public function getId();

    /**
     * Returns a hash code for this object.
     *
     * @return integer A hash code. 
     */
    public function getHashCode();

    /**
     * Returns the class of this object.
     *
     * @return object ReflectionClass A ReflectionClass.
     */
    public function getClass();
}
