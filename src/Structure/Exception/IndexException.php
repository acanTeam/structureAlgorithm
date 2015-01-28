<?php

namespace Structure\Exception;

/**
 * Index error exception.
 */
class IndexException extends \Exception implements ExceptionInterface
{
    /**
     * Constructs an IndexError.
     */
    public function __construct()
    {
        parent::__construct(__CLASS__);
    }
}
