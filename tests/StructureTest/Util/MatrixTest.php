<?php

use \Structure\Util\Matrix\MatrixInterface;

class MatrixTest extends PHPUnit_Framework_TestCase
{
    //private $basicArrayObject = null;

    public function setUp()
    {
        //$param = array(1, 2, 3);//, 3, 4);
        //$this->dimension = new Structure\Util\MultiDimensionalArray($param);
    }

    public function tearDown()
    {
        //unset($this->basicArrayObject);
    }

    public function testDense()
    {
        $matrix = new \Structure\Util\Matrix\Dense(6, 6);

        $this->baseMethod($matrix);
        $this->transposeMethod($matrix);
        $this->timesMethod($matrix, $matrix);
    }

    public function testSparseAsArray()
    {
        return ;
        $matrix = new \Structure\Util\Matrix\SparseAsArray(6, 6, 6);
        $this->baseMethod($matrix);
        $this->transposeMethod($matrix);

        $matrix1 = new \Structure\Util\Matrix\SparseAsArray(3, 3, 3);
        $this->timesMethod($matrix1, $matrix1);
    }

    public function testSparseAsLinkedList()
    {
        return ;

        $mat = new SparseMatrixAsLinkedList(6, 6, 6);
        AbstractMatrix::test($mat);
        AbstractMatrix::testTranspose($mat);

        $mat1 = new SparseMatrixAsLinkedList(3, 3, 3);
        $mat2 = new SparseMatrixAsLinkedList(3, 3, 3);
        AbstractMatrix::testTimes($mat1, $mat2);

    }

    public function testSparseAsVector()
    {
        return ;

        $mat = new SparseMatrixAsVector(6, 6, 6);
        AbstractMatrix::test($mat);
        AbstractMatrix::testTranspose($mat);
        $mat1 = new SparseMatrixAsVector(3, 3, 9);
        $mat2 = new SparseMatrixAsVector(3, 3, 9);
        AbstractMatrix::testTimes($mat1, $mat2);
    }

    /**
     * Matrix base operation.
     *
     * @param object MatrixInterface $matrix The matrix to test.
     */
    protected function baseMethod(MatrixInterface $matrix)
    {
        $k = 0;
        for ($i = 0; $i < $matrix->getNumRows(); ++$i) {
            for ($j = 0; $j < $matrix->getNumCols(); ++$j) {
                $matrix[array($i, $j)] = $k++;
            }
        }
        printf("\n%s\n", str($matrix));
        $matrix = $matrix->plus($matrix);
        //printf("\n%s\n", str($matrix));
    }

    /**
     * Matrix transpose test program.
     *
     * @param object MatrixInterface $matrix The matrix to test.
     */
    protected function transposeMethod(MatrixInterface $matrix)
    {
        $matrix = $matrix->getTranspose();
        //printf("%s\n", str($matrix));
    }

    /**
     * Matrix multiply test program.
     *
     * @param object MatrixInterface $matrix1 A matrix to test.
     * @param object MatrixInterface $matrix2 A matrix to test.
     */
    protected function timesMethod(MatrixInterface $matrix1, MatrixInterface $matrix2)
    {
        $matrix1 = $matrix2->times($matrix1);
        //printf("%s\n", str($matrix1));
    }    
}

