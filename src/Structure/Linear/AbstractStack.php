<?php

namespace Structure\Linear;

use Structure\Base\AbstractContainer;
use Structure\Base\Box;

/**
 * Abstract base class from which all stack classes are derived.
 */
abstract class AbstractStack extends AbstractContainer implements StackInterface
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
