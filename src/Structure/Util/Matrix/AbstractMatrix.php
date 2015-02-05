<?php

namespace Structure\Util\Matrix;

use Structure\Base\AbstractObject;

/**
 * Abstract base class from which all matrix classes are derived.
 */
abstract class AbstractMatrix extends AbstractObject implements MatrixInterface
{
    /**
     * @var integer The number of rows.
     */
    protected $numRows = 0;

    /**
     * @var integer The number of columns.
     */
    protected $numCols = 0;


    /**
     * Constructs an AbstractMatrix with the given number of rows and columns.
     *
     * @param integer $numRows The number of rows.
     * @param integer $numCols The number of columns.
     */
    public function __construct($numRows, $numCols)
    {
        parent::__construct();

        $this->numRows = $numRows;
        $this->numCols = $numCols;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Rows getter.
     *
     * @return integer The number of rows.
     */
    public function getNumRows()
    {
        return $this->numRows;
    }

    /**
     * Columns getter.
     *
     * @return integer The number of columns.
     */
    public function getNumCols()
    {
        return $this->numCols;
    }

    /**
     * Returns a textual representation of this matrix.
     *
     * @return string A string.
     */
    public function __toString()
    {
        $string = '';
        for ($i = 0; $i < $this->numRows; ++$i) {
            for ($j = 0; $j < $this->numCols; ++$j) {
                $elem = $this->offsetGet(array($i, $j));
                $string .= $this->_formatElem($elem);
            }
            $string .= "\n";
        }

        return $string;
    }

    /**
     * Format the string
     *
     * @param string $string The string to be formated
     * @param int $lengthTarget The length of the result
     * @return string
     */
    protected function _formatElem($string, $lengthTarget = 8)
    {
        $length = strlen($string);
        if ($length > $lengthTarget)  {
            $string = substr(0, $lengthTarget, $string);
        } elseif ($length < $lengthTarget) {
            $string = str_repeat(' ', $lengthTarget - $length) . $string;
        }

        return $string;
    }    
}
