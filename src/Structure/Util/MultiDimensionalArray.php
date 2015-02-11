<?php

namespace Structure\Util;

use Structure\Base\AbstractObject;

/**
 * Represents a multi-dimensional array.
 */
class MultiDimensionalArray extends AbstractObject implements \ArrayAccess
{
    /**
     * @var object BasicArray The dimensions of the array.
     */
    protected $dimensions = null;

    /**
     * @var object BasicArray Used in the calculation that maps 
     * a set of indices into a position in a one-dimensional array.
     */
    protected $factors = null;

    /**
     * @var object BasicArray A one-dimensional array that holds 
     * the elements of the multi-dimensional array.
     */
    protected $data = null;

    /**
     * Constructs a MultiDimensionalArray with the specified dimensions.
     */
    public function __construct($dimensions)
    {
        parent::__construct();

        $length = sizeof($dimensions);
        $this->dimensions = new BasicArray($length);
        $this->factors = new BasicArray($length);

        $product = 1;
        for ($i = $length - 1; $i >= 0; --$i) {
            $this->dimensions[$i] = $dimensions[$i];
            $this->factors[$i] = $product;
            $product *= $this->dimensions[$i];
        }
        $this->data = new BasicArray($product);
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $this->dimesions = $this->factors = $this->data = null;

        parent::__destruct();
    }

    /**
     * Maps a set of indices for the multi-dimensional array
     * into the corresponding position in the one-dimensional array.
     *
     * @param array $indices The set of indices.
     */
    private function getOffset($indices)
    {
        $length = $this->dimensions->getLength();
        if (sizeof($indices) != $length) {
            throw new \Structure\Exception\IndexException();
        }

        $offset = 0;
        for ($i = 0; $i < $length; ++$i) {
            if ($indices[$i] < 0 || $indices[$i] >= $this->dimensions[$i]) {
                throw new \Structure\Exception\IndexException();
            }
            $offset += $this->factors[$i] * $indices[$i];
        }

        return $offset;
    }

    /**
     * Returns true if the given set of indices is valid.
     *
     * @param array $indices A set of indices.
     * @return boolean True if the given set of indices is valid.
     */
    public function offsetExists($indices)
    {
        $this->getOffset($indices);
    }

    /**
     * Returns the item in this array at the given indices.
     *
     * @param array $indices A set of indices.
     * @return mixed The item at the given indices.
     */
    public function offsetGet($indices)
    {
        return $this->data[$this->getOffset($indices)];
    }

    /**
     * Sets the item in this array at the given indices to the given value.
     *
     * @param array $indices A set of indices.
     * @param mixed $value A value.
     */
    public function offsetSet($indices, $value)
    {
        $this->data[$this->getOffset($indices)] = $value;
    }

    /**
     * Unsets the item in this array at the given indices.
     *
     * @param array $indices A set of indices.
     */
    public function offsetUnset($indices)
    {
        $this->data[$this->getOffset($indices)] = null;
    }

    public function getData()
    {
        return $this->data;
    }
}
