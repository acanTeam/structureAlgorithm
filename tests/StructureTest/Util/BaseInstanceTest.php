<?php

class BaseInstanceTest extends PHPUnit_Framework_TestCase
{
    private $filesPath = null;

    public function setUp()
    {
        $this->filesPath = __DIR__ . './../_files/';

        $abstractObjectFile = $this->filesPath . 'AbstractObjectInstance.php';
        require_once($abstractObjectFile);
        $this->abstractObject = new AbstractObjectInstance();
    }

    public function tearDown()
    {
    }

    public function testGetId()
    {
        $getId = $this->abstractObject->getId();
        $hash = $this->abstractObject->getHashCode();
        $this->assertEquals($getId, $hash);

        $abstractObject = $this->abstractObject;
        $getId2 = $abstractObject->getId();
        $this->assertSame($getId, $getId2);

        $abstractObjectNew = new AbstractObjectInstance();
        $getId3 = $abstractObjectNew->getId();
        $this->assertNotEquals($getId, $getId3);
    }

    public function testGetName()
    {
        $this->assertEquals('AbstractObjectInstance', $this->abstractObject->getClass()->getName());
    }

    public function testToString()
    {
        $this->assertEquals('AbstractObjectInstance', strval($this->abstractObject));
    }
}

