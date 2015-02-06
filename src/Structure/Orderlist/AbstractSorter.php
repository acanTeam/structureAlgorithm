<?php

namespace Structure\Orderlist;

use Structure\Base\AbstractObject;
use Structure\Base\ComparableInterface;
use Structure\Util\BasicArray;

/**
 * Abstract base class from which all sorter classes are derived.
 */
abstract class AbstractSorter extends AbstractObject implements SorterInterface
{
    /**
     * @var object BasicArray The array to be sorted.
     */
    protected $array = null;

    /**
     * @var integer The length of the array to be sorted.
     */
    protected $n = 0;

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

    /**
     * Sorts the array to which the array field refers.
     */
    protected abstract function doSort();

    /**
     * Sorts the specified array of comparable objects
     * from "smallest" to "largest".
     * Calls the abstract <code>sort</code> method to do the actual sort.
     *
     * @param object BasicArray $array The array of objects to be sorted.
     */
    public function sort(BasicArray $array)
    {
        $this->n = $array->getLength();
        $this->array = $array;
        if ($this->n > 0) {
            $this->doSort();
        }
        $this->array = null;
    }

    /**
     * Swaps the specified elements the array
     * to which the array field refers.
     *
     * @param integer $i An index.
     * @param integer $j An index.
     */
    protected function swap($i, $j)
    {
        $tmp = $this->array[$i];
        $this->array[$i] = $this->array[$j];
        $this->array[$j] = $tmp;
    }
}
