<?php

class BoxTest extends PHPUnit_Framework_TestCase
{
    //private $basicArrayObject = null;

    public function setUp()
    {
    }

    public function testBase()
    {
        $box = box(false);
        $this->assertEquals('false', $box);

        $box = box(57);
        $this->assertEquals(57, str($box));

        $box = box(1.5);
        $this->assertEquals(1.5, str($box));

        $box = box('test');
        $this->assertEquals('test', str($box));

        $box = box(array(1,2,3));
        $target = "Array{baseIndex=0, length=3, data=(1, 2, 3)}";
        $this->assertEquals($target, str($box));
    }

    public function testBoolean()
    {
        $false = new \Structure\Util\Boxed\BoxedBoolean(false);
        $this->assertEquals('false', str($false));

        $true = new \Structure\Util\Boxed\BoxedBoolean(true);
        $this->assertEquals('true', str($true));

        $this->assertEquals('true', str(lt($false, $true)));
        $this->assertEquals('false', str(eq($false, $true)));

        //$this->assertEquals(0, myhash($false));
        //$this->assertEquals(1, myhash($true));
    }

    public function testFloat()
    {
        $float1 = new \Structure\Util\Boxed\BoxedFloat(1.0);
        $this->assertEquals(1, str($float1));

        $float2 = new \Structure\Util\Boxed\BoxedFloat(0.5);
        $this->assertEquals(0.5, str($float2));
        $this->assertEquals('false', str(lt($float1, $float2)));

        $float3 = new \Structure\Util\Boxed\BoxedFloat('-123.0e6');
        $this->assertEquals(-123000000, str($float3));

        //echo myhash(new \Structure\Util\Boxed\BoxedFloat(14.0));
    }

    public function testInteger()
    {
        $integer1 = new \Structure\Util\Boxed\BoxedInteger(57);
        $this->assertEquals(57, str($integer1));

        $integer2 = new \Structure\Util\Boxed\BoxedInteger(-57);
        $this->assertEquals(-57, str($integer2));

        $integer3 = new \Structure\Util\Boxed\BoxedInteger(-57.01);
        $this->assertEquals(-57, str($integer3));

        //myhash($integer3);
    }

    public function testString()
    {
        $string1 = new \Structure\Util\Boxed\BoxedString('string1');
        $this->assertEquals('string1', str($string1));

        $string2 = new \Structure\Util\Boxed\BoxedString('string "1"');
        $this->assertEquals('string "1"', str($string2));

        $this->assertTrue(gt($string1, $string2));

        //echo myhash($string1);
        //\Structure\Util\Boxed\BoxedString::testHash();
    }
}
