<?php

namespace Structure\Util\Matrix;

use Structure\Base\AbstractObject;
use Structure\Util\MultiDimensionalArray;

/**
 * A dense matrix implemented using a multi-dimensional array with 2 dimensions.
 */
class Dense extends AbstractMatrix
{
    /**
     * @var object MultiDimensionalArray The multi-dimensional array.
     */
    protected $array = null;

    /**
     * Constructs a DenseMatrix with the given number of rows and columns.
     *
     * @param integer $rows The number of rows.
     * @param integer $columns The number of columns.
     */
    public function __construct($rows, $columns)
    {
        parent::__construct($rows, $columns);
        $this->array = new MultiDimensionalArray(array($rows, $columns));
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $this->array = null;
        parent::__destruct();
    }

    /**
     * Returns true if the given indices are valid.
     *
     * @param array $indices A set of indices.
     * @return boolean True if the given indices are valid.
     */
    public function offsetExists($indices)
    {
        return $this->array->offsetExists($indices);
    }

    /**
     * Returns the item in this array at the given indices.
     *
     * @param array $indices A set of indices.
     * @return mixed The item at the given indices.
     */
    public function offsetGet($indices)
    {
        return $this->array[$indices];
    }

    /**
     * Sets the item in this array at the given indices to the given value.
     *
     * @param array $indices A set of indices.
     * @param mixed $value A value.
     */
    public function offsetSet($indices, $value)
    {
        $this->array[$indices] = $value;
    }

    /**
     * Unsets the item in this array at the given indices.
     *
     * @param array $indices A set of indices.
     */
    public function offsetUnset($indices)
    {
        $this->array[$indices] = null;
    }

    /**
     * Returns the product of this dense matrix and the given dense matrix.
     *
     * @param object DenseMatrix $mat A dense matrix.
     * @return object DenseMatrix The product.
     */
    public function times(MatrixInterface $mat)
    {
        if (!($mat instanceof self) ||
            $this->getNumCols() != $mat->getNumRows()) {
            throw new \Structure\Exception\ArgumentException();
        }

        $result = new Dense($this->getNumRows(), $mat->getNumCols());

        for ($i = 0; $i < $this->getNumRows(); ++$i) {
            for ($j = 0; $j < $mat->getNumCols(); ++$j) {
                $sum = 0;
                for ($k = 0; $k < $this->getNumCols(); ++$k) {
                    $sum += $this[array($i, $k)] * $mat[array($k, $j)];
                }
                $result[array($i, $j)] = $sum;
            }
        }
        return $result;
    }

    /**
     * Returns the sum of this dense matrix and the given dense matrix.
     *
     * @param object DenseMatrix $mat A dense matrix.
     * @return object DenseMatrix The sum.
     */
    public function plus(MatrixInterface $mat)
    {
        if (!($mat instanceof self) ||
            $this->getNumRows() != $mat->getNumRows() ||
            $this->getNumCols() != $mat->getNumCols()) {
            throw new \Structure\Exception\ArgumentException();
        }

        $result = new Dense($this->getNumRows(), $this->getNumCols());
        for ($i = 0; $i < $this->getNumRows(); ++$i) {
            for ($j = 0; $j < $this->getNumCols(); ++$j) {
                $result[array($i, $j)] = $this[array($i, $j)] + $mat[array($i, $j)];
            }
        }
        return $result;
    }

    /**
     * Returns the transpose of this dense matrix.
     *
     * @return object DenseMatrix The tranpose.
     */
    public function getTranspose()
    {
        $result = new Dense($this->getNumCols(), $this->getNumRows());
        for ($i = 0; $i < $this->getNumRows(); ++$i) {
            for ($j = 0; $j < $this->getNumCols(); ++$j) {
                $result[array($j, $i)] = $this[array($i, $j)];
            }
        }

        return $result;
    }
}
