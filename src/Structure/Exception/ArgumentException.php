<?php

namespace Structure\Exception;

class ArgumentException extends \Exception implements ExceptionInterface
{
    /**
     * Constructs an ArgumentError.
     */
    public function __construct()
    {
        parent::__construct(__CLASS__);
    }
}
