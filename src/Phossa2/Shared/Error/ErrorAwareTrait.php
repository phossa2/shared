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
 * ErrorAwareTrait
 *
 * Implementation of ErrorAwareInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     ErrorAwareInterface
 * @version 2.0.24
 * @since   2.0.22 added
 * @since   2.0.24 added flushError()
 */
trait ErrorAwareTrait
{
    /**
     * error message
     *
     * @var    string
     * @access protected
     */
    protected $error = '';

    /**
     * error code
     *
     * @var    string
     * @access protected
     */
    protected $error_code = '';

    /**
     * 0 or '0000' etc means no error, = ''
     *
     * @var    bool
     * @access protected
     */
    protected $zero_empty = true;

    /**
     * {@inheritDoc}
     */
    public function hasError()/*# : bool */
    {
        return '' === $this->error_code;
    }

    /**
     * {@inheritDoc}
     */
    public function getError()/*# : string */
    {
        return $this->error;
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorCode()/*# : string */
    {
        return $this->error_code;
    }

    /**
     * {@inheritDoc}
     */
    public function setError(
        /*# string */ $message = '',
        /*# string */ $code = ''
    )/*# : bool */ {
        $this->error = (string) $message;

        // zero ?
        $zcode = (string) $code;
        if ($this->zero_empty && '' === str_replace('0', '', $zcode)) {
            $this->error_code = '';
        } else {
            $this->error_code = $zcode;
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function copyError($obj)
    {
        if ($obj instanceof ErrorAwareInterface) {
            $this->setError($obj->getError(), $obj->getErrorCode());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function flushError()/*# : bool */
    {
        $this->setError();
        return true;
    }
}
