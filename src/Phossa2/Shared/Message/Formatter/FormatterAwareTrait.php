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
 * FormatterAwareTrait
 *
 * One implementation of `FormatterAwareInterface`
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     FormatterAwareInterface
 * @version 2.0.0
 * @since   2.0.0 added
 */
trait FormatterAwareTrait
{
    /**
     * Message formatter
     *
     * Formatter is shared by all descendant message classes.
     *
     * @var    FormatterInterface
     * @access private
     */
    private static $formatter;

    /**
     * Set formatter
     *
     * @param  FormatterInterface $formatter the message formatter
     * @access public
     * @api
     */
    public static function setFormatter(
        FormatterInterface $formatter
    ) {
        self::$formatter = $formatter;
    }

    /**
     * Unset formatter
     *
     * @access public
     * @api
     */
    public static function unsetFormatter()
    {
        self::$formatter = null;
    }

    /**
     * Get formatter. if not set, use the `DefaultFormatter`
     *
     * @return FormatterInterface
     * @access protected
     */
    protected static function getFormatter()/*# : FormatterInterface */
    {
        if (null === self::$formatter) {
            self::$formatter = new DefaultFormatter();
        }
        return self::$formatter;
    }
}
