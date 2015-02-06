<?php

namespace Structure\Base;

/**
 * Abstract base class from which all iterator classes are derived.
 */
abstract class AbstractIterator implements IteratorInterface
{
    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
    }

    /**
     * Returns the next object to be enumerated by this iterator.
     * Returns null when there are no more objects.
     *
     * @return mixed The next object to be enumerated.
     */
    public function succ()
    {
        $result = null;
        if ($this->valid()) {
            $result = $this->current();
            $this->next();
        }
        return $result;
    }
}
