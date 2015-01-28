<?php

namespace Structure\Exception;

/**
 * Container empty exception.
 */
class ContainerEmptyException extends \Exception implements ExceptionInterface
{
    /**
     * Constructs a ContainerEmptyException.
     */
    public function __construct()
    {
        parent::__construct(__CLASS__);
    }
}
