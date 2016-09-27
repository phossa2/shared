<?php
/**
 * Phossa Project
 *
 * PHP version 5.4
 *
 * @category  Library
 * @package   Phossa2\Shared
 * @copyright Copyright (c) 2016 phossa.com
 * @license   http://mit-license.org/ MIT License
 * @link      http://www.phossa.com/
 */
/*# declare(strict_types=1); */

namespace Phossa2\Shared\Queue;

/**
 * PriorityQueueTrait
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     PriorityQueueInterface
 * @version 2.0.20
 * @since   2.0.20 added
 * @since   2.0.21 updated to store extra data
 */
trait PriorityQueueTrait
{
    /**
     * inner data storage
     *
     * @var    array
     * @access protected
     */
    protected $queue = [];

    /**
     * marker for sorted queue
     *
     * @var    bool
     * @access protected
     */
    protected $sorted = false;

    /**
     * priority counter, descreasing
     *
     * @var    int
     * @access protected
     */
    protected $counter = 10000000;

    /**
     * {@inheritDoc}
     *
     * @since  2.0.21 added extra data
     */
    public function insert($data, /*# int */ $priority = 0, $extra = null)
    {
        // fix priority
        $pri = $this->fixPriority((int) $priority);

        // generate key to be used (int)
        $key = $this->generateKey($pri);

        // make sure not duplicated
        $this->remove($data);

        // added to the queue
        $this->queue[$key] = [
            'data' => $data, 'priority' => $pri, 'extra' => $extra
        ];

        // mark as not sorted
        $this->sorted = false;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function remove($data)
    {
        foreach ($this->queue as $key => $val) {
            if ($val['data'] === $data) {
                unset($this->queue[$key]);
                break;
            }
        }
        return $this;
    }

    /**
     * {@inheritdic}
     */
    public function flush()
    {
        $this->queue = [];
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function combine(
        PriorityQueueInterface $queue
    )/*# : PriorityQueueInterface */ {
        // clone a new queue
        $nqueue = clone $this;

        // insert into new queue
        foreach ($queue as $data) {
            $nqueue->insert($data['data'], $data['priority'], $data['extra']);
        }

        return $nqueue;
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return count($this->queue);
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        // sort queue if not yet
        $this->sortQueue();

        // return iterator
        return new \ArrayIterator($this->queue);
    }

    /**
     * Make sure priority in the range of -100 - +100
     *
     * @param  int $priority
     * @return int
     * @access protected
     */
    protected function fixPriority(/*# int */ $priority)/*# : int */
    {
        return (int) ($priority > 100 ? 100 : ($priority < -100 ? -100 : $priority));
    }

    /**
     * Generate one int base on the priority
     *
     * @param  int $priority
     * @return int
     * @access protected
     */
    protected function generateKey(/*# int */ $priority)/*# : int */
    {
        return ($priority + 100) * 10000000 + --$this->counter;
    }

    /**
     * Sort the queue from higher to lower int $key
     *
     * @return $this
     * @access protected
     */
    protected function sortQueue()
    {
        if (!$this->sorted) {
            krsort($this->queue);
            $this->sorted = true;
        }
        return $this;
    }
}
