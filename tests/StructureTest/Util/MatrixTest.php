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
        $matrix = new \Structure\Util\Matrix\Dense(3, 3);

        $matrix = $this->assignMatrix($matrix);
        $this->assertEquals(8, $matrix[array(2, 2)]);
        $this->assertEquals(6, $matrix[array(2, 0)]);
        //printf("\n%s\n", str($matrix));

        $matrix = $matrix->getTranspose();
        $this->assertEquals(6, $matrix[array(0, 2)]);
        //printf("%s\n", str($matrix));
        
        $matrix = $matrix->plus($matrix);
        $this->assertEquals(16, $matrix[array(2, 2)]);
        //printf("\n%s\n", str($matrix));

        $matrix = $matrix->times($matrix);
        $this->assertEquals(444, $matrix[array(2, 2)]);
        //printf("%s\n", str($matrix));
    }

    public function testSparseAsArray()
    {
        $matrix = new \Structure\Util\Matrix\SparseAsArray(6, 6, 6);
        //$matrix = $this->assignMatrix($matrix);
        //$matrix->putZero(array(2, 3));
        //print_r($matrix);

        //$matrix1 = new \Structure\Util\Matrix\SparseAsArray(3, 3, 3);
    }

    public function testSparseAsLinkedList()
    {
        $matrix = new \Structure\Util\Matrix\SparseAsLinkedList(6, 6, 6);
        $matrix[array(2, 3)] = 10;
        //print_r($matrix);exit();
    }

    public function testSparseAsVector()
    {
        $matrix = new \Structure\Util\Matrix\SparseAsVector(6, 6, 6);
        print_r($matrix);exit();
        AbstractMatrix::test($mat);
        AbstractMatrix::testTranspose($mat);
        $mat1 = new SparseAsVector(3, 3, 9);
        $mat2 = new SparseAsVector(3, 3, 9);
        AbstractMatrix::testTimes($mat1, $mat2);
    }

    /**
     * Matrix base operation.
     *
     * @param object MatrixInterface $matrix The matrix to test.
     */
    protected function assignMatrix(MatrixInterface $matrix)
    {
        $k = 0;
        for ($i = 0; $i < $matrix->getNumRows(); ++$i) {
            for ($j = 0; $j < $matrix->getNumCols(); ++$j) {
                $matrix[array($i, $j)] = $k++;
            }
        }

        return $matrix;
    }
}

