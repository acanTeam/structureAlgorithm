<?php

class MultiDimensionalArrayTest extends PHPUnit_Framework_TestCase
{
    //private $basicArrayObject = null;

    public function setUp()
    {
        //print_r($this->dimension);
    }

    public function tearDown()
    {
        //unset($this->basicArrayObject);
    }

    public function testConstruct()
    {
        $param = array(3, 3, 4);
        $dimension = new Structure\Util\MultiDimensionalArray($param);
        
        $dimension[array(2, 2, 3)] = 10;

        $data = $dimension->getData();
        $this->assertEquals(10, $data[35]);
        $this->assertEquals(36, $data->getLength());

        try {
            $dimension[array(2, 2, 4)] = 10;
        } catch (\Structure\Exception\IndexException $e) {
            $this->assertInstanceOf('\Structure\Exception\IndexException', $e);
        }
    }
}

