<?php

namespace Structure\Exception;

/**
 * Illegal operation exception.
 */
class IllegalOperationException extends \Exception implements ExceptionInterface
{
    /**
     * Constructs an IllegalOperationException.
     */
    public function __construct()
    {
        parent::__construct(__CLASS__);
    }
}
