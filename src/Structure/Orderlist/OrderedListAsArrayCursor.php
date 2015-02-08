<?php

namespace Structure\Orderlist;

/**
 * Represents a position in an OrderedListAsArray.
 */
class OrderedListAsArrayCursor extends AbstractCursor
{
    /**
     * @var object OrderedListAsArray The ordered list.
     */
    protected $list = null;
    /**
     * @var integer The current offset.
     */
    protected $offset = 0;

//}@head

//{
//!    // ...
//!}
//}@tail

//{
    /**
     * Constructs a OrderedListAsArray_Cursor
     * with the given list and offset.
     *
     * @param object OrderedListAsArray $list A list.
     * @param integer $offset The offset.
     */
    public function __construct(
        OrderedListAsArray $list, $offset = 0)
    {
        parent::__construct();
        $this->list = $list;
        $this->offset = $offset;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $this->list = null;
        parent::__destruct();
    }

    /**
     * Valid predicate.
     *
     * @return boolean True if the current position of this iterator is valid.
     */
    public function valid()
    {
        return $this->offset < $this->list->getCount();
    }

    /**
     * Key getter.
     *
     * @return integer The key for the current position of this iterator.
     */
    public function key()
    {
        return $this->offset;
    }

    /**
     * Current getter.
     *
     * @return mixed The value for the current postion of this iterator.
     */
    public function current()
    {
        $array = $this->list->getArray();
        return $array[$this->offset];
    }

    /**
     * Advances this iterator to the next position.
     */
    public function next()
    {
        $this->offset += 1;
    }

    /**
     * Rewinds this iterator to the first position.
     */
    public function rewind()
    {
        $this->offset = 0;
    }
//}>h

//{
    /**
     * Inserts the specified object in the ordered list
     * after this position.
     * @param object IObject $obj The object to insert.
     */
    public function insertAfter(IObject $obj)
    {
        if (!$this->valid())
            throw new IndexError();
        if ($this->list->isFull())
            throw new ContainerFullException();

        $insertPosition = $this->offset + 1;

        $array = $this->list->getArray();
            for ($i = $this->list->getCount();
                $i > $insertPosition; --$i)
                $array[$i] = $array[$i - 1];
            $array[$insertPosition] = $obj;
            $this->list->setCount($this->list->getCount() + 1);
        }
//}>f

    /**
     * Inserts the specified object in the ordered list
     * before this position.
     * @param object IObject $obj The object to insert.
     */
    public function insertBefore(IObject $obj)
    {
        if (!$this->valid())
            throw new IndexError();
        if ($this->list->isFull())
            throw new ContainerFullException();

        $insertPosition = $this->offset;

        $array = $this->list->getArray();
        for ($i = $this->list->getCount();
            $i > $insertPosition; --$i)
            $array[$i] = $array[$i - 1];
        $array[$insertPosition] = $obj;
        $this->list->setCount($this->list->getCount() + 1);
        $this->offset += 1;
    }

//{
    /**
     * Withdraws the object in the ordered list at this position.
     */
    public function withdraw()
    {
        if (!$this->valid())
            throw new IndexError();
        if ($this->list->getCount() == 0)
            throw new ContainerEmptyException();

        $i = $this->offset;
        $array = $this->list->getArray();
        while ($i < $this->list->getCount() - 1)
        {
            $array[$i] = $array[$i + 1];
            ++$i;
        }
        $array[$i] = null;
        $this->list->setCount($this->list->getCount() - 1);
    }
//}>g
}
