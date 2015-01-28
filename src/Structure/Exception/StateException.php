<?php

namespace Structure\Exception;

/**
 * State error exception.
 */
class StateException extends \Exception implements ExceptionInterface
{
    /**
     * Constructs an ArgumentError.
     */
    public function __construct()
    {
        parent::__construct(__CLASS__);
    }
}
