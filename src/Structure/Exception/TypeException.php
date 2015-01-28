<?php

namespace Structure\Exception;

/**
 * Type error exception.
 */
class TypeException extends \Exception implements ExceptionInterface
{
    /**
     * Constructs an ArgumentError.
     */
    public function __construct()
    {
        parent::__construct(__CLASS__);
    }
}
