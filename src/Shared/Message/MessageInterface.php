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

namespace Phossa2\Shared\Message;

/**
 * MessageInterface
 *
 * Convert a message code (int) into a human readable message.
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.0
 * @since   2.0.0 added
 */
interface MessageInterface
{
    /**
     * Get the message base on the code and other arguments
     *
     * This method takes variable arguments. the first argument is the message
     * code (int), the remaining arguments are for the '%s' in the message
     * sprintf template.
     *
     * ```php
     * class MyMessage extends MessageAbstract
     * {
     *     const MSG_HELLO = 1606061210;
     *
     *     protected static $messages = [
     *         self::MSG_HELLO => 'Hello "%s"',
     *     ];
     * }
     *
     * // result: 'Hello John'
     * MyMessage::get(MyMessage::MSG_HELLO, 'John');
     * ```
     *
     * @param  int $code message code
     * @return string
     * @access public
     * @api
     */
    public static function get(/*# int */ $code)/*# : string */;
}
