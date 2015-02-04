<?php

namespace Structure\Util;

use Structure\Base\AbstractComparable;
use Structure\Base\ComparableInterface;

/**
 * Represents a string.
 */
class BoxedString extends Box
{
    /**
     * Constructs a BoxedString with the given value.
     *
     * @param string $value A value.
     */
    public function __construct($value)
    {
        parent::__construct(strval($value));
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Value setter.
     *
     * @param string $value A value.
     */
    public function setValue($value)
    {
        $this->value = strval($value);
    }

    /**
     * Compares this object with the given object.
     * This object and the given object are instances of the same class.
     *
     * @param object IComparable $obj The given object.
     * @return integer A number less than zero
     * if this object is less than the given object,
     * zero if this object equals the given object, and
     * a number greater than zero
     * if this object is greater than the given object.
     */
    protected function compareTo(ComparableInterface $obj)
    {
        return strcmp($this->value, $obj->value);
    }

    const SHIFT = 6;
    const MASK = 0xfc000000;

    public function getHashCodebak()
    {
        $result = 0;
        $length = strlen($this->value);
        for ($i = 0; $i < $length; ++$i) {
            $result = ($result & self::MASK)
                ^ ($result << self::SHIFT) 
                ^ ord($this->value[$i]);
        }
        return $result;
    }

    public static function testHash()
    {
        $strings = array(
            'ett', 'tva', 'tre', 'fyra', 'fem', 'sex', 
            'sju', 'atta', 'nio', 'tio', 'elva', 'tolv'
        );
        foreach ($strings as $string) {
            $stringObject = new BoxedString($string);
            $hash = $stringObject->getHashCodebak();
            echo $hash . "\n";
        }

        $strings = array(
            'abcdefghijklmnopqrstuvwxy',
            'ece.uwaterloo.ca',
            'cs.uwaterloo.ca',
            'un', 'deux', 'trois', 'quatre', 'cinq', 
            'siz', 'sept', 'huit', 'neuf', 'dix', 'onze', 'douze'
        );
        foreach ($strings as $string) {
            $stringObject = new BoxedString($string);
            $hash = $stringObject->getHashCodebak();
            echo $hash . "\n";
        }
    }
}
