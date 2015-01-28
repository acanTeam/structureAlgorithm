<?php

namespace Structure\Exception;

/**
 * Method not implemented exception.
 */
class MethodNotImplementedException extends \Exception implements ExceptionInterface
{
    /**
     * Constructs an MethodNotImplementedException.
     */
    public function __construct()
    {
        parent::__construct(__CLASS__);
    }
}
