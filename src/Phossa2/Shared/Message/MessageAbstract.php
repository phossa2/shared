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

use Phossa2\Shared\Base\StaticAbstract;
use Phossa2\Shared\Message\Mapping\MappingTrait;
use Phossa2\Shared\Message\Mapping\MappingInterface;
use Phossa2\Shared\Message\Loader\LoaderAwareInterface;
use Phossa2\Shared\Message\Formatter\FormatterAwareTrait;
use Phossa2\Shared\Message\Formatter\FormatterAwareInterface;

/**
 * MessageAbstract
 *
 * - Used to convert message code into human-readable messages.
 *
 * - Subclass *MUST* define its own property `$messages`
 *
 * - Message loader maybe used to load different message mapping such as
 *   language files.
 *
 * - Message formatter maybe used to output message in different format.
 *
 * - Once loader set for parent class, it will affect all the descendant
 *   classes unless they have own loader set.
 *
 * - extending `MessageAbstract`
 *
 *   ```php
 *   use Phossa2\Shared\Message\MessageAbstract
 *
 *   // define own message class
 *   class MyMessage extends MessageAbstract
 *   {
 *       // define unique message codes, usually YearMonthDateMinute
 *       const MSG_HELLO = 1606151214;
 *
 *       // MUST define message template mappings
 *       protected static $messages = [
 *           self::MSG_HELLO => 'Hello %s'
 *       ];
 *   }
 *   ```
 *
 * - usage
 *
 *   ```php
 *   // print 'Hello World'
 *   echo MyMessage::get(MyMessage::MSG_HELLO, 'World');
 *
 *   // used in exception
 *   throw new \Exception(MyMessage::get(MyMessage::MSG_HELLO, 'John'));
 *   ```
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     StaticAbstract
 * @see     MessageInterface
 * @see     LoaderAwareInterface
 * @see     FormatterAwareInterface
 * @version 2.0.0
 * @since   2.0.0 added
 */
abstract class MessageAbstract extends StaticAbstract implements MessageInterface, MappingInterface, LoaderAwareInterface, FormatterAwareInterface
{
    use MappingTrait, FormatterAwareTrait;

    /**
     * {@inheritDoc}
     */
    public static function get(/*# int */ $code)/*# : string */
    {
        // process code
        if (!is_numeric($code)) {
            return is_scalar($code) ? (string) $code : print_r($code, true);
        } else {
            $code = (int) $code;
        }

        // get remaining arguments if any
        $arguments = func_get_args();
        array_shift($arguments);

        // build message and return it
        return self::getFormatter()->formatMessage(
            self::getTemplateByCode($code, get_called_class()),
            $arguments
        );
    }
}
