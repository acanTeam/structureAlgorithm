<?php

namespace Structure\Util\Matrix;

/**
 * Interface implemented by all sparse matrix classes.
 */
interface SparseInterface extends MatrixInterface
{
    /**
     * Stores a zero value in this matrix at the given indices.
     *
     * @param array $indices A set of indices.
     */
    public function putZero($indices);
}
