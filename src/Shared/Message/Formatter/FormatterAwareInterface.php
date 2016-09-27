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

namespace Phossa2\Shared\Message\Formatter;

/**
 * FormatterAwareInterface
 *
 * Formatter is used to format the result message.
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.0
 * @since   2.0.0 added
 */
interface FormatterAwareInterface
{
    /**
     * Set formatter
     *
     * @param  FormatterInterface $formatter the message formatter
     * @access public
     * @api
     */
    public static function setFormatter(
        FormatterInterface $formatter
    );

    /**
     * Unset formatter
     *
     * @access public
     * @api
     */
    public static function unsetFormatter();
}
