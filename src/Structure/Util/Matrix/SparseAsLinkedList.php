<?php

namespace Structure\Util\Matrix;

use Structure\Util\BasicArray;
use Structure\Linear\LinkedList;

/**
 * Sparse matrix implemented using an array of linked lists.
 */
class SparseAsLinkedList extends AbstractMatrix implements SparseInterface
{
    /**
     * @var object BasicArray
     * An array of linked lists---one linked list for each row.
     */
    protected $lists = null;

    /**
     * Construct a <code>SparseAsLinkedLists</code>
     * with the specified dimensions.
     *
     * @param integer $numRows The number of rows.
     * @param integer $numCols The number of columns.
     */
    public function __construct($numRows, $numCols)
    {
        parent::__construct($numRows, $numCols);

        $this->lists = new BasicArray($numRows);
        for ($i = 0; $i < $this->numRows; ++$i) {
            $this->lists[$i] = new LinkedList();
        }
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $this->lists = null;
    }

    /**
     * Returns true if the given set of indices is valid.
     *
     * @param array $indices A set of indices.
     * @return boolean True if the given set of indices is valid.
     */
    public function offsetExists($indices)
    {
        return $indices[0] >= 0 && $indices[0] < $this->numRows &&
            $indices[1] >= 0 && $indices[1] < $this->numCols;
    }

    /**
     * Returns the value in this matrix at the specified indices.
     *
     * @param array $indices A set of indices.
     * @return mixed The value in this matrix at the specified position.
     */
    public function offsetGet($indices)
    {
        if (!$this->offsetExists($indices)) {
            throw new \Structure\Exception\IndexException();
        }

        $i = $indices[0];
        $j = $indices[1];
        for ($ptr = $this->lists[$i]->getHead(); $ptr !== null; $ptr = $ptr->getNext()) {
            $entry = $ptr->getDatum();
            if ($entry->getColumn() == $j) {
                return $entry->getDatum();
            }
            if ($entry->getColumn() > $j) {
                break;
            }
        }
        return 0;
    }

    /**
     * Stores the specified value in this matrix at the specified indices.
     *
     * @param array $indices The indices.
     * @param mixed $datum The value to be stored.
     */
    public function offsetSet($indices, $datum)
    {
        if (!$this->offsetExists($indices)) {
            throw new \Structure\Exception\IndexException();
        }

        $i = $indices[0];
        $j = $indices[1];
        for ($ptr = $this->lists[$i]->getHead(); $ptr !== null; $ptr = $ptr->getNext()) {
            $entry = $ptr->getDatum();
            if ($entry->getColumn() == $j) {
                $entry->setDatum($datum);
                return;
            } elseif ($entry->getColumn() > $j) {
                $ptr->insertBefore(new SparseAsLinkedListEntry($i, $j, $datum));
                return;
            }
        }
        $this->lists[$i]->append(new SparseAsLinkedListEntry($i, $j, $datum));
    }

    /**
     * Stores a zero in this matrix at the specified indices.
     *
     * @param array $indices A set of indices.
     * @param mixed $datum The value to be stored.
     */
    public function offsetUnset($indices)
    {
        $this->putZero($indices);
    }

    /**
     * Stores a zero in this matrix at the specified indices.
     *
     * @param array $indices The indices.
     * @param mixed $datum The value to be stored.
     */
    public function putZero($indices)
    {
        if (!$this->offsetExists($indices)) {
            throw new \Structure\Exception\IndexException();
        }

        $i = $indices[0];
        $j = $indices[1];
        for ($ptr = $this->lists[i]->getHead(); $ptr !== null; $ptr = $ptr->getNext()) {
            $entry = $ptr->getDatum();
            if ($entry->getColumn() == $j) {
                $this->lists[i]->extract($entry);
                return;
            }
        }
    }

    /**
     * Returns the transpose of this matrix.
     *
     * @return object SparseAsLinkedList The transpose of this matrix.
     */
    public function getTranspose()
    {
        $result = new SparseAsLinkedList($this->numCols, $this->numRows);
        for ($i = 0; $i < $this->numCols; ++$i) {
            for ($ptr = $this->lists[$i]->getHead(); $ptr !== null; $ptr = $ptr->getNext()) {
                $entry = $ptr->getDatum();
                $newEntry = SparseAsLinkedListEntry($entry->getColumn(), $entry->getRow(), $entry->getDatum());
                $result->lists[$entry->getColumn()]->append($newEntry);
            }
        }
        return $result;
    }

    /**
     * Returns the product of this matrix and the specified matrix.
     * This method is not implemented.
     *
     * @param object MatrixInterface $mat The specified matrix.
     * @return object SparseAsLinkedList
     * The product of this matrix and the specified matrix
     * @exception MethodNotImplemented Always.
     */
    public function times(MatrixInterface $mat)
    {
        throw new MethodNotImplementedException();
    }

    /**
     * Returns the sum of this matrix and the specified matrix.
     * This method is not implemented.
     * @param object MatrixInterface $mat The specified matrix.
     * @return object SparseAsLinkedList
     * The sum of this matrix and the specified matrix
     * @exception MethodNotImplemented Always.
     */
    public function plus(MatrixInterface $mat)
    {
        throw new MethodNotImplementedException();
    }
}
