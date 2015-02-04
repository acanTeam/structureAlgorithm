<?php

class MultiDimensionalArrayTest extends PHPUnit_Framework_TestCase
{
    //private $basicArrayObject = null;

    public function setUp()
    {
        $param = array(1, 2, 3);//, 3, 4);
        $this->dimension = new Structure\Util\MultiDimensionalArray($param);
        //print_r($this->dimension);
    }

    public function tearDown()
    {
        //unset($this->basicArrayObject);
    }

    public function testConstruct()
    {
    }
}

