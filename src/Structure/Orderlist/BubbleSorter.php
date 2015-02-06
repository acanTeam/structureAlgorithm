<?php

namespace Structure\Orderlist;

/**
 * Implements bubble sort.
 */
class BubbleSorter extends AbstractSorter
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Sorts the array of comparable objects.
     */
    protected function doSort()
    {
        for ($i = $this->n; $i > 1; --$i)
            for ($j = 0; $j < $i - 1; ++$j)
                if (gt($this->array[$j], $this->array[$j + 1]))
                    $this->swap($j, $j + 1);
    }

    /**
     * Main program.
     *
     * @param array $args Command-line arguments.
     * @return integer Zero on success; non-zero on failure.
     */
    public static function main($args)
    {
        printf("BubbleSorter main program.\n");
        $status = 0;
        $sorter = new BubbleSorter();
        AbstractSorter::test($sorter, 100, 123);
        return $status;
    }
}
