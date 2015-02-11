<?php

namespace Structure\Linear;

/**
 * Represents an element of a linked list.
 */
class LinkedListElement
{
    /**
     * @var object LinkedList The linked list to which this element belongs.
     */
    protected $list = null;

    /**
     * @var mixed The datum in this element.
     */
    protected $datum = null;

    /**
     * @var object LinkedListElement The next list element.
     */
    protected $next = null;

    /**
     * Constructs a LinkedListElement with the given values.
     *
     * @param mixed $list A linked list.
     * @param mixed $datum An item.
     * @param mixed $next The next element.
     */
    public function __construct($list, $datum, $next)
    {
        $this->list = $list;
        $this->datum = $datum;
        $this->next = $next;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
    }

    /**
     * List getter.
     * 
     * @return object LinkedList The list of this element.
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Datum getter.
     *
     * @return mixed The datum of this element.
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Next getter.
     *
     * @return mixed The next element of this element.
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * Next setter.
     *
     * @param object LinkedListElement $next The new next element.
     */
    public function setNext(LinkedListElement $next)
    {
        if ($this->list !== $next->list) {
            throw new \Structure\Exception\ArgumentException();
        }
        $this->next = $next;
    }

    /**
     * Next unsetter.
     */
    public function unsetNext()
    {
        $this->next = null;
    }

    /**
     * Inserts the given item in the linked list after this element.
     *
     * @param mixed $item The item to insert.
     */
    public function insertAfter($item)
    {
        $this->next = new LinkedListElement($this->list, $item, $this->next);
        if ($this->list->getTail() === $this) {
            $this->list->setTail($this->next);
        }
    }

    /**
     * Inserts the given item in the linked list before this element.
     *
     * @param mixed $item The item to insert.
     */
    public function insertBefore($item)
    {
        $tmp = new LinkedListElement($this->list, $item, $this);
        if ($this === $this->list->getHead()) {
            if ($tmp === null) {
                $list->unsetHead();
            } else {
                $list->setHead($tmp);
            }
        } else {
            $prevPtr = $this->list->getHead();
            while ($prevPtr !== null && $prevPtr->next != $this) {
                $prevPtr = $prevPtr->next;
            }
            $prevPtr->next = $tmp;
        }
    }

    /**
     * Extracts this list element from the linked list.
     */
    public function extract()
    {
        $prevPtr = null;
        if ($this->list->getHead() === $this) {
            if ($this->next === null) {
                $list->unsetHead();
            } else {
                $list->setHead($this->next);
            }
        } else {
            $prevPtr = $this->list->getHead();
            while ($prevPtr !== null && $prevPtr->next != $this) {
                $prevPtr = $prevPtr->next;
            }
            if (prevPtr === null) {
                throw new \Structure\Exception\ArgumentException();
            }
            $prevPtr->next = $this->next;
        }

        if ($this->list->getTail() === $this) {
            if ($prevPtr === null) {
                $list->unsetTail();
            } else {
                $list->setTail($prevPtr);
            }
        }
    }
}
