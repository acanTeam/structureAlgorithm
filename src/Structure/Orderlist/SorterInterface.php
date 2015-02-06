<?php

namespace Structure\Orderlist;

use Structure\Base\ObjectInterface;
use Structure\Util\BasicArray;

/**
 * Interface implemented by all sorters.
 * A sorter is an abstract machine that sorts an array of comparable objects.
 */
interface SorterInterface extends ObjectInterface
{
    /**
     * Sorts the specified array of comparable
     * objects from "smallest" to "largest".
     *
     * @param object BasicArray $array The array of objects to be sorted.
     */
    public function sort(BasicArray $array);
}
