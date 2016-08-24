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

namespace Phossa2\Shared\Debug;

use Psr\Log\LoggerInterface;

/**
 * DebuggableInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.26
 * @since   2.0.26 added
 */
interface DebuggableInterface
{
    /**
     * Enable debugging
     *
     * @param  bool $flag
     * @return $this
     * @access public
     * @api
     */
    public function enableDebug(/*# bool */ $flag = true);

    /**
     * Set the logger
     *
     * @param  LoggerInterface $logger
     * @return $this;
     * @access public
     * @api
     */
    public function setDebugger(LoggerInterface $logger);

    /**
     * Delete debugger to object $object
     *
     * @return object $object
     * @access public
     * @api
     */
    public function delegateDebugger($object);

    /**
     * Both enabled and debugger is set
     *
     * @return bool
     * @access public
     * @api
     */
    public function isDebugging()/*# : bool */;

    /**
     * Send debug message
     *
     * @param  string $message
     * @return $this
     * @access public
     */
    public function debug(/*# string */ $message);
}
