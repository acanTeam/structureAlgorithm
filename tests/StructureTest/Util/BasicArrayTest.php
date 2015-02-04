<?php

class BasicArrayTest extends PHPUnit_Framework_TestCase
{
    //private $basicArrayObject = null;

    public function setUp()
    {
        $param = array('a', 'b', 'c', 'd');
        $this->basicArray = new Structure\Util\BasicArray($param);
    }

    public function tearDown()
    {
        //unset($this->basicArrayObject);
    }

    public function testConstruct()
    {
        $param = 5;
        $baseIndex = '10abc';
        $basicArray = new Structure\Util\BasicArray($param, $baseIndex);

        $this->assertEquals(5, $basicArray->getLength());
        $this->assertEquals(10, $basicArray->getBaseIndex());
        $this->assertEquals(null, $basicArray[10]);

        $param = array('a', array('abc'), 'b', 'c');
        $basicArray = new Structure\Util\BasicArray($param);

        $this->assertEquals(count($param), $basicArray->getLength());
        $this->assertEquals(0, $basicArray->getBaseIndex());
        $this->assertEquals(null, $basicArray[1]);
    }

    public function testLengthBaseIndex()
    {
        $this->assertEquals(4, $this->basicArray->getLength());
        $this->basicArray->setLength(10);
        $this->assertEquals(10, $this->basicArray->getLength());
        $this->assertEquals('a', $this->basicArray[0]);
        $this->assertEquals(null, $this->basicArray[4]);

        $this->assertEquals(0, $this->basicArray->getBaseIndex());
        $this->basicArray->setBaseIndex(10);
        $this->assertEquals(10, $this->basicArray->getBaseIndex());
        $this->assertEquals('a', $this->basicArray[10]);
    }

    public function testArrayAccess()
    {
        $this->assertEquals('a', $this->basicArray[0]);
        $this->basicArray[1] = 'z';
        $this->assertEquals('z', $this->basicArray[1]);
        $this->assertEquals(false, isset($this->basicArray[5]));

        unset($this->basicArray[3]);
        $this->assertEquals(false, isset($this->basicArray[3]));
        $this->assertEquals(array('a', 'z', 'c'), $this->basicArray->getData());

        try {
            $this->basicArray[4];
        } catch (\Structure\Exception\IndexException $e) {
            $this->assertInstanceOf('\Structure\Exception\IndexException', $e);
        }
    }

    public function testReduce()
    {
        $reduce = $this->basicArray->reduce();

        $this->assertEquals($reduce[0], 'a, b, c, d');
    }

    public function testToString()
    {
        $string = strval($this->basicArray);
        $targetString = 'Array{baseIndex=' . $this->basicArray->getBaseIndex() 
            . ', length=' . $this->basicArray->getLength() 
            . ', data=(' . implode(', ', $this->basicArray->getData()) . ')}';

        $this->assertEquals($string, $targetString);
    }
}

