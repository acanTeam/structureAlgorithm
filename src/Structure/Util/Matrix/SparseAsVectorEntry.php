<?php

namespace Structure\Util\Matrix;

/**
 * Data structure used to represent a matrix entry.
 */
class SparseMatrixAsVectorEntry
{
    /**
     * @var integer The row number.
     */
    protected $row;

    /**
     * @var integer The column number.
     */
    protected $column;

    /**
     * @var mixed The matrix entry.
     */
    protected $datum;

    /**
     * Construct an Entry with the specified values.
     *
     * @param integer $row The row number.
     * @param integer $column The column number.
     * @param mixed $datum The matrix entry.
     */
    public function __construct($row = 0, $column = 0, $datum = 0)
    {
        $this->row = $row;
        $this->column = $column;
        $this->datum = $datum;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
    }

    /**
     * Row getter.
     *
     * @return integer The row.
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * Column getter.
     *
     * @return integer The column.
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Datum getter.
     *
     * @return mixed The datum.
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Datum setter.
     *
     * @param mixed $datum The datum.
     */
     public function setDatum($datum)
     {
        $this->datum = $datum;
     }

     /**
      * Returns a textual representation of this matrix entry.
      *
      * @return string A string.
      */
    public function __toString()
    {
        return sprintf("[%d,%d]=%s",
            $this->row, $this->column, str($this->datum));
    }
}
