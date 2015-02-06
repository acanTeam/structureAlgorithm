<?php

namespace Structure\Linear;

use Structure\Base\AbstractObject;

/**
 * Represents a linked list.
 */
class LinkedList extends AbstractObject
{
    /**
     * @var object LinkedList_Element
     * The element at the head of the linked list.
     */
    protected $head = null;

    /**
     * @var object LinkedList_Element
     * The element at the tail of the linked list.
     */
    protected $tail = null;

    /**
     * Constructs a LinkedList.
     */
    public function __construct()
    {
        parent::__construct();
        $this->head = null;
        $this->tail = null;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $this->head = null;
        $this->tail = null;
        parent::__destruct();
    }

    /**
     * Purges this linked list.
     */
    public function purge()
    {
        $this->head = null;
        $this->tail = null;
    }

    /**
     * Head getter.
     *
     * @return mixed The head element of this linked list.
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * Head setter.
     *
     * @param object LinkedListElement $element An element.
     */
    public function setHead(LinkedListElement $element)
    {
        if ($element->getList() !== $this)
            throw new ArgumentError();
        $this->head = $element;
    }

    /**
     * Head unsetter.
     */
    public function unsetHead()
    {
        $this->head = null;
    }

    /**
     * Tail getter.
     *
     * @return mixed The tail element of this linked list.
     */
    public function getTail()
    {
        return $this->tail;
    }

    /**
     * Tail setter.
     *
     * @param object LinkedListElement $element An element.
     */
    public function setTail(LinkedListElement $element)
    {
        if ($element->getList() !== $this)
            throw new ArgumentError();
        $this->tail = $element;
    }

    /**
     * Tail unsetter.
     */
    public function unsetTail()
    {
        $this->tail = null;
    }

    /**
     * IsEmpty predicate.
     *
     * @return boolean True if this linked list is empty.
     */
    public function isEmpty()
    {
        return $this->head === null;
    }

    /**
     * First getter.
     *
     * @return mixed The first item in this linked list.
     */
    public function getFirst()
    {
        if ($this->head === null)
            throw new ContainerEmptyException();
        return $this->head->getDatum();
    }

    /**
     * Last getter.
     *
     * @return mixed The last item in this linked list.
     */
    public function getLast()
    {
        if ($this->tail === null)
            throw new ContainerEmptyException();
        return $this->tail->getDatum();
    }
    
    /**
     * Prepends the given item to this linked list.
     *
     * @param mixed $item The item to prepend.
     */
    public function prepend($item)
    {
        $tmp = new LinkedListElement($this, $item, $this->head);
        if ($this->head === null)
            $this->tail = $tmp;
        $this->head = $tmp;
    }

    /**
     * Appends the given item to this linked list.
     *
     * @param mixed $item The item to append.
     */
    public function append($item)
    {
        $tmp = new LinkedListElement($this, $item, null);
        if ($this->head === null)
            $this->head = $tmp;
        else
            $this->tail->setNext($tmp);
        $this->tail = $tmp;
    }

    /**
     * Returns a clone of this linked list.
     *
     * @return object LinkedList A LinkedList.
     */
    public function __clone()
    {
        $result = new LinkedList();
        for ($ptr = $this->head;
            $ptr !== null; $ptr = $ptr->getNext())
        {
            $result->append($ptr->getDatum());
        }
        return $result;
    }

    /**
     * Extracts an item that equals the given item from this linked list.
     *
     * @param mixed $item The item to extract.
     */
    public function extract($item)
    {
        $ptr = $this->head;
        $prevPtr = null;
        while ($ptr !== null && $ptr->getDatum() !== $item)
        {
            $prevPtr = $ptr;
            $ptr = $ptr->getNext();
        }
        if ($ptr === null)
            throw new ArgumentError();
        if ($ptr === $this->head)
            $this->head = $ptr->getNext();
        else
        {
            $tmp = $ptr->getNext();
            if ($tmp === null)
                $prevPtr->unsetNext();
            else
                $prevPtr->setNext($ptr->getNext());
        }
        if ($ptr === $this->tail)
            $this->tail = $prevPtr;
    }

    /**
     * Returns a value computed by calling the given callback function
     * for each item in this container.
     * Each time the callback function will be called with two arguments:
     * The first argument is the next item in this container.
     * The first time the callback function is called,
     * the second argument is the given initial value.
     * On subsequent calls to the callback function,
     * the second argument is the result returned from
     * the previous call to the callback function.
     *
     * @param callback $callback A callback function.
     * @param mixed $initialState The initial state.
     * @return mixed The value returned by
     * the last call to the callback function.
     */
    public function reduce($callback, $initialState)
    {
        $state = $initialState;
        $ptr = $this->head;
        while ($ptr !== null)
        {
            $state = $callback($state, $ptr->getDatum());
            $ptr = $ptr->getNext();
        }
        return $state;
    }

    /**
     * Returns a textual representation of this linked list.
     *
     * @return string A string.
     */
    public function __toString()
    {
        $s = $this->reduce(
            create_function(
                '$s, $item', 
                'return array($s[0] . $s[1] . str($item), ", ");'
            ), array('',''));
        return 'LinkedList{' . $s[0] . '}';
    }
}
