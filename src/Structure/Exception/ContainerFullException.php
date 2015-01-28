<?php

namespace Structure\Exception;

/**
 * Container full exception.
 */
class ContainerFullException extends \Exception implements ExceptionInterface
{
    /**
     * Constructs a ContainerFullException.
     */
    public function __construct()
    {
        parent::__construct(__CLASS__);
    }
}
