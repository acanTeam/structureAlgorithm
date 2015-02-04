<?php
require './init.php';
$basicArray = new Structure\Util\BasicArray();
print_r($basicArray);
exit();

require_once './DenseMatrix.php';
//require_once './SparseMatrixAsArray.php';
//require_once './SparseMatrixAsVector.php';
//require_once './SparseMatrixAsLinkedList.php';

/**
 * Provides demonstration program number 1.
 *
 * @package Opus11
 */
class Demo1
{
    /**
     * Main program.
     *
     * @param array $args Command-line arguments.
     * @return integer $Zero on success; non-zero on failure.
     */
    public static function main($args)
    {
        printf("Demonstration program number 1.\n");
        $status = 0;
        DenseMatrix::main($args);
        //SparseMatrixAsArray::main($args);
        //SparseMatrixAsVector::main($args);
        //SparseMatrixAsLinkedList::main($args);
        return $status;
    }
}

if (realpath($argv[0]) == realpath(__FILE__))
{
    exit(Demo1::main(array_slice($argv, 1)));
}
?>
