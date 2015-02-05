<?php

namespace Structure\Util\Matrix;

use Structure\Base\ObjectInterface;

/**
 * Interface implemented by all matrix classes.
 */
interface MatrixInterface extends ObjectInterface, \ArrayAccess
{
    /**
     * Rows getter.
     *
     * @return integer The number of rows in this matrix.
     */
    public function getNumRows();

    /**
     * Columns getter.
     *
     * @return integer The number of columns in this matrix.
     */
    public function getNumCols();

    /**
     * Returns the transpose of this matrix.
     *
     * @return object MatrixInterface The transpose.
     */
    public function getTranspose();
    
    /**
     * Returns the sum of this matrix and the given matrix.
     *
     * @param object MatrixInterface $matrix A matrix.
     * @return object MatrixInterface The sum.
     */
    public function plus(MatrixInterface $matrix);

    /**
     * Returns the product of this matrix and the given matrix.
     *
     * @param object MatrixInterface $matrix A matrix.
     * @return object MatrixInterface The product.
     */
    public function times(MatrixInterface $matrix);
}
