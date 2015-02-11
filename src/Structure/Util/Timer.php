<?php

namespace Structure\Util;

/**
 * A timer for measuring elapsed time.
 */
class Timer
{
    /**
     * @var integer The stopped state.
     */
    const STOPPED = 1;

    /**
     * @var integer The running state.
     */
    const RUNNING = 2;

    /**
     * @var integer The current state.
     */
    protected $state = self::STOPPED;

    /**
     * @var float The start time.
     */
    protected $startTime = 0.0;

    /**
     * @var float The stop time.
     */
    protected $stopTime = 0.0;

    /**
     * Constructs a Timer.
     */
    public function __construct()
    {
        $this->state = self::STOPPED;
        $this->startTime = microtime(true);
        $this->stopTime = microtime(true);
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
    }

    /**
     * Starts this timer.
     */
    public function start()
    {
        if ($this->state != self::STOPPED) {
            throw new \Structure\Exception\StateException();
        }

        $this->startTime = microtime(true);
        $this->state = self::RUNNING;
        return $this->startTime;
    }

    /**
     * Stops this timer.
     */
    public function stop()
    {
        if ($this->state != self::RUNNING) {
            throw new \Structure\Exception\StateException();
        }

        $this->stopTime = microtime(true);
        $this->state = self::STOPPED;

        return $this->stopTime;
    }

    /**
     * Elapsed time getter.
     *
     * @returns float The elapsed time.
     */
    public function getElapsedTime()
    {
        if ($this->state == self::RUNNING) {
            $this->stopTime = microtime(true);
        }
        return $this->stopTime - $this->startTime;
    }
}
