<?php

namespace Structure\Linear;

use Structure\Base\AbstractContainer;
use Structure\Util\Box;

/**
 * Abstract base class from which all queue classes are derived.
 */
abstract class AbstractQueue extends AbstractContainer implements QueueInterface
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }
}
