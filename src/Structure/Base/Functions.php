<?php

/**
 * Returns a hash code for the given item.
 *
 * @param mixed item An item.
 * @return integer A hash code.
 */
function myhash($item)
{
    $type = gettype($item);
    if ($type == 'object') {
        return $item->getHashCode();
    } elseif ($type == 'NULL') {
        return 0;
    } else {
        throw new \Exception\ArgumentException();
    }
}

/**
 * Returns a textual representation of the given item.
 *
 * @param mixed item An item.
 * @return string A string.
 */
function str($item)
{
    $type = gettype($item);
    switch ($type) {
    case 'boolean':
        return $item ? 'true' : 'false';
    case 'object':
        return $item->__toString();
    case 'NULL':
        return 'NULL';
    default:
        return strval($item);
    }
}

/**
 * Returns true if the given items compare equal.
 *
 * @param mixed $left An item.
 * @param mixed $right An item.
 * @return boolean True if the given items are equal.
 */
function eq($left, $right)
{
    if (gettype($left) == 'object' && gettype($right) == 'object') {
        return $left->eq($right);
    } else {
        return $left == $right;
    }
}

/**
 * Returns true if the given items compare not equal.
 *
 * @param mixed $left An item.
 * @param mixed $right An item.
 * @return boolean True if the given items are not equal.
 */
function ne($left, $right)
{
    if (gettype($left) == 'object' && gettype($right) == 'object') {
        return $left->ne($right);
    } else {
        return $left != $right;
    }
}

/**
 * Returns true if the left item is greater than the right item.
 *
 * @param mixed $left An item.
 * @param mixed $right An item.
 * @return boolean True if the given items are equal.
 */
function gt($left, $right)
{
    if (gettype($left) == 'object' && gettype($right) == 'object') {
        return $left->gt($right);
    } else {
        return $left > $right;
    }
}

/**
 * Returns true if the left item is greater than or equal to the right item.
 *
 * @param mixed $left An item.
 * @param mixed $right An item.
 * @return boolean True if the given items are equal.
 */
function ge($left, $right)
{
    if (gettype($left) == 'object' && gettype($right) == 'object') {
        return $left->ge($right);
    } else {
        return $left >= $right;
    }
}

/**
 * Returns true if the left item is less than the right item.
 *
 * @param mixed $left An item.
 * @param mixed $right An item.
 * @return boolean True if the given items are equal.
 */
function lt($left, $right)
{
    if (gettype($left) == 'object' && gettype($right) == 'object') {
        return $left->lt($right);
    } else {
        return $left < $right;
    }
}

/**
 * Returns true if the left item is less than or equal to the right item.
 *
 * @param mixed $left An item.
 * @param mixed $right An item.
 * @return boolean True if the given items are equal.
 */
function le($left, $right)
{
    if (gettype($left) == 'object' && gettype($right) == 'object') {
        return $left->le($right);
    } else {
        return $left <= $right;
    }
}

/**
 * Boxes the given value.
 *
 * @param mixed $value A value.
 * @return object Box A boxed value.
 */
function box($value)
{
    $type = gettype($value);
    //var_dump($value);
    //echo '##' . $type . "\n";
    switch ($type) {
    case 'boolean':
        return new \Structure\Util\Boxed\BoxedBoolean($value);
    case 'integer':
        return new \Structure\Util\Boxed\BoxedInteger($value);
    case 'float':
    case 'double':
        return new \Structure\Util\Boxed\BoxedFloat($value);
    case 'string':
        return new \Structure\Util\Boxed\BoxedString($value);
    case 'array':
        return new \Structure\Util\BasicArray($value);
    default:
        throw new \Structure\Exception\TypeException();
    }
}

/**
 * Unboxes the given value.
 *
 * @param object Box box A boxed value.
 * @return mixed The value in the box.
 */
function unbox($box)
{
    return $box->getValue();
}
