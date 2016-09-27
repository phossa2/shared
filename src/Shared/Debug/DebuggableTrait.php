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
 * DebuggableTrait
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     DebuggableInterface
 * @version 2.0.26
 * @since   2.0.26 added
 */
trait DebuggableTrait
{
    /**
     * @var    bool
     * @access protected
     */
    protected $debug_mode = false;

    /**
     * @var    LoggerInterface
     * @access protected
     */
    protected $debug_logger;

    /**
     * {@inheritDoc}
     */
    public function enableDebug(/*# bool */ $flag = true)
    {
        $this->debug_mode = (bool) $flag;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setDebugger(LoggerInterface $logger)
    {
        $this->debug_logger = $logger;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function delegateDebugger($object)
    {
        if ($this->isDebugging() &&
            $object instanceof DebuggableInterface
        ) {
            $object->enableDebug(true)->setDebugger($this->debug_logger);
        }
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isDebugging()/*# : bool */
    {
        return (bool) ($this->debug_mode && $this->debug_logger);
    }

    /**
     * {@inheritDoc}
     */
    public function debug(/*# string */ $message)
    {
        if ($this->isDebugging()) {
            $this->debug_logger->debug(
                $message,
                ['className' => get_class($this)]
            );
        }
        return $this;
    }
}
