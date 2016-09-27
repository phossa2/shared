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

namespace Phossa2\Shared\Error;

/**
 * ErrorAwareInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.24
 * @since   2.0.22 added
 * @since   2.0.24 added flushError()
 */
interface ErrorAwareInterface
{
    /**
     * Error happened?
     *
     * @return bool
     * @access public
     * @api
     */
    public function hasError()/*# : bool */;

    /**
     * Get current error message. Returns '' for no error
     *
     * @return string
     * @access public
     * @api
     */
    public function getError()/*# : string */;

    /**
     * Get current error code. '' for no error
     *
     * @return string
     * @access public
     * @api
     */
    public function getErrorCode()/*# : string */;

    /**
     * Set the error message and (optional) error code.
     *
     * Flush current error/code with ''
     *
     * @param  string $message (optional) error message
     * @param  string $code (optional) error code
     * @return false
     * @access public
     * @api
     */
    public function setError(
        /*# string */ $message = '',
        /*# string */ $code = ''
    )/*# : bool */;

    /**
     * Retrieve error from object and set own
     *
     * @param  object $obj
     * @access public
     * @api
     */
    public function copyError($obj);

    /**
     * Reset the error, returns true
     *
     * @return true
     * @access public
     * @since  2.0.24 added
     * @api
     */
    public function flushError()/*# : bool */;
}
