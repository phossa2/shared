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
 * PriorityQueueInterface
 *
 * Looks like PHP's priority queue has bugs in HHVM. So we write a new one here.
 *
 * Range for priority: -100 - +100,  higher returned first !
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.20
 * @since   2.0.20 added
 * @since   2.0.21 updated to store extra data
 */
interface PriorityQueueInterface extends \IteratorAggregate, \Countable
{
    /**
     * Insert data into the queue with priority
     *
     * @param  mixed $data
     * @param  int $priority priority, higher number retrieved first
     * @param  mixed $extra extra data to store
     * @return $this
     * @access public
     * @since  2.0.21 added extra data
     * @api
     */
    public function insert($data, /*# int */ $priority = 0, $extra = null);

    /**
     * Remove data from the queue if any
     *
     * @param  mixed $data
     * @return $this
     * @access public
     * @api
     */
    public function remove($data);

    /**
     * Empty/flush the queue
     *
     * @return $this
     * @access public
     * @api
     */
    public function flush();

    /**
     * Combine with queue and return a combined new queue
     *
     * @param  PriorityQueueInterface $queue
     * @return PriorityQueueInterface
     * @access public
     * @api
     */
    public function combine(
        PriorityQueueInterface $queue
    )/*# : PriorityQueue */;
}
