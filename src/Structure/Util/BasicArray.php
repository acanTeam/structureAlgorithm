<?php

namespace Structure\Util;

use Structure\Base\AbstractObject;

/**
 * A basic array class.
 */
class BasicArray extends AbstractObject implements \ArrayAccess
{
    /**
     * The array data.
     */
    protected $data = NULL;

    /**
     * The length of the array.
     */
    protected $length = 0;

    /**
     * The base index of the array.
     */
    protected $baseIndex = 0;

    /**
     * Constructs a BasicArray.
     *
     * @param mixed $param Either an integer or an array.
     *     If an integer, this argument specifies the array length.
     *     If an array, this array is initialized with contents of the given array.
     * @param int $arg2 The base index.
     */
    public function __construct($param = 0, $baseIndex = 0)
    {
        parent::__construct();

        $type = gettype($param);
        switch ($type) {
        case 'integer':
            $this->length = $param;
            for ($i = 0; $i < $this->length; ++$i) {
                $this->data[$i] = null;
            }
            break;
        case 'array':
            $this->length = sizeof($param);
            for ($i = 0; $i < $this->length; ++$i) {
                $this->data[$i] = is_scalar($param[$i]) ? $param[$i] : null;
            }
            break;
        default:
            throw new TypeError();
        }

        $this->baseIndex = intval($baseIndex);
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $this->data = null;
        parent::__destruct();
    }

    /**
     * Returns a clone of this array.
     * @return object BasicArray A BasicArray.
     */
    public function __clone()
    {
        $result = new BasicArray(
            $this->length, $this->baseIndex);
        for ($i = 0; $i < $this->length; ++$i)
        {
            $result->data[$i] = $this->data[$i];
        }
        return $result;
    }

    /**
     * Returns true if the given index is valid.
     *
     * @param integer $index An index.
     * @return boolean True if the given index is valid.
     */
    public function offsetExists($index)
    {
        return $index >= $this->baseIndex &&
            $index < $this->baseIndex + $this->length;
    }

    /**
     * Returns the item in this array at the given index.
     *
     * @param integer $index An index.
     * @return mixed The item at the given index.
     */
    public function offsetGet($index)
    {
        if (!$this->offsetExists($index)) {
            throw new \Structure\Exception\IndexException();
        }
        return $this->data[$index - $this->baseIndex];
    }

    /**
     * Sets the item in this array at the given index to the given value.
     *
     * @param integer $index An index.
     * @param mixed $value A value.
     */
    public function offsetSet($index, $value)
    {
        if (!$this->offsetExists($index)) {
            throw new \Structure\Exception\IndexException();
        }
        $this->data[$index - $this->baseIndex] = $value;
    }

    /**
     * Unsets the item in this array at the given index.
     *
     * @param integer $index An index.
     */
    public function offsetUnset($index)
    {
        if (!$this->offsetExists($index)) {
            throw new \Structure\Exception\IndexException();
        }
        unset($this->data[$index - $this->baseIndex]);
        $this->length--;
    }

    /**
     * Data getter.
     *
     * @return array The data of this array.
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * BaseIndex getter.
     *
     * @return integer The base index of this array.
     */
    public function getBaseIndex()
    {
        return $this->baseIndex;
    }

    /**
     * BaseIndex setter.
     *
     * @param integer $baseIndex A base index.
     */
    public function setBaseIndex($baseIndex)
    {
        $this->baseIndex = $baseIndex;
    }

    /**
     * Length getter.
     *
     * @return integer The length of this array.
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Length setter.
     *
     * @param integer $length A length.
     */
    public function setLength($length)
    {
        if ($this->length == $length) {
            return ;
        }

        $newData = array();
        for ($i = 0; $i < $length; ++$i) {
            $newData[$i] = isset($this->data[$i]) ? $this->data[$i] : null;
        }

        $this->data = $newData;
        $this->length = $length;
    }

    /**
     * Returns a value computed by calling the given callback function
     * for each item in this array. Each time the callback function 
     * will be called with two arguments: The first argument is the 
     * next item in this array. The first time the callback function 
     * is called, the second argument is the given initial value. On 
     * subsequent calls to the callback function, the second argument 
     * is the result returned from the previous call to the callback 
     * function.
     *
     * @param callback $callback A callback function.
     * @param mixed $initialState The initial state.
     * @return mixed The value returned by the last call to the callback function.
     */
    public function reduce()
    {
        $callback = create_function(
            '$s, $item',
            'return array($s[0] . $s[1] . str($item), ", ");'
        );
        $initialState = array('', '');

        return array_reduce($this->data, $callback, $initialState);
    }

    /**
     * Returns a textual representation of this array.
     *
     * @return string A string.
     */
    public function __toString()
    {
        $stringInfos = $this->reduce();
        return 'Array{baseIndex=' . $this->baseIndex . ', length=' . $this->length . ', data=(' . $stringInfos[0] . ')}';
    }
}    
