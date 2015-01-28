<?php

/**
 * Returns a hash code for the given item.
 *
 * @param mixed item An item.
 * @return integer A hash code.
 */
function hash($item)
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
