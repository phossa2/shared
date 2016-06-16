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

namespace Phossa2\Shared\Message\Mapping;

use Phossa2\Shared\Message\Loader\LoaderAwareTrait;

/**
 * MappingTrait
 *
 * One implementation of `MappingInterface`
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     MappingInterface
 * @version 2.0.0
 * @since   2.0.0 added
 */
trait MappingTrait
{
    use LoaderAwareTrait;

    /**
     * Ddefault messages for current message class
     *
     * This property HAS TO BE redefined for each descendant message class !
     *
     * @var    string[]
     * @access protected
     */
    protected static $messages = [];

    /**
     * Message mapping cache
     *
     * @var    array
     * @access private
     */
    private static $mappings = [];

    /**
     * Reset current message class' code to message mappings cache
     *
     * ```php
     *     MyMessage::setMappings([
     *         MyMessage::MSG_HELLO => 'Hello %s'
     *     ]);
     * ```
     *
     * @param  array $messages messages mapping array
     * @param  bool $manual manually, not auto load from $loader
     * @access public
     * @api
     */
    public static function setMappings(
        array $messages,
        /*# bool */ $manual = true
    ) {
        $class = get_called_class();

        if ($manual) {
            // set default
            static::$messages = $messages;

            // status changed
            self::setStatus();
        } else {
            // set cache
            self::$mappings[$class] = array_replace(
                $class::getMappings(),
                $messages
            );
        }
    }

    /**
     * Check current class' message mapping cache
     *
     * @return bool
     * @access protected
     */
    protected static function hasMappings()/*# : bool */
    {
        return isset(self::$mappings[get_called_class()]);
    }

    /**
     * Get current class' message mapping, default or cached
     *
     * @return array
     * @access protected
     */
    protected static function getMappings()/*# : array */
    {
        // use cached first if any
        if (static::hasMappings()) {
            return self::$mappings[get_called_class()];
        }

        // return the default
        return static::$messages;
    }

    /**
     * Clear the mapping cache
     *
     * @access protected
     */
    protected static function resetMappings()
    {
        self::$mappings = [];
    }

    /**
     * Check message template in default mapping
     *
     * @param  int $code the message code
     * @return bool
     * @access protected
     */
    protected static function messageDefined(/*# int */ $code)/*# : bool */
    {
        return isset(static::$messages[$code]);
    }

    /**
     * Resolving code for current message class, from cache or default
     *
     * If nothing found, return the code anyway
     *
     * @param  int $code the message code
     * @return string
     * @access protected
     */
    protected static function getMessage(/*# int */ $code)/*# : string */
    {
        $mapping = static::getMappings();
        if (isset($mapping[$code])) {
            return $mapping[$code];
        }
        return (string) $code;
    }

    /**
     * Resolving $code to message template, start from $class
     *
     * @param  int $code message code
     * @param  string $class class name
     * @return string
     * @access protected
     */
    protected static function getTemplateByCode(
        /*# int */ $code,
        /*# string */ $class
    )/*# : string */ {
        // search $code upwards in inheritance tree
        do {
            // default message template
            $template = 'message: %s';

            // code is defined for $class
            if ($class::messageDefined($code)) {
                // load message mapping for $class
                self::loadMappings($class);

                // get the message template
                $template = $class::getMessage($code);
                break;
            }

            // last resort, use the default message template
            if ($class === __CLASS__) {
                break;
            }

            $class = get_parent_class($class);

        } while ($class);

        return $template;
    }

    /**
     * Load message mappings into cache for $class
     *
     * @param  string $class fully qualified class name
     * @access protected
     */
    protected static function loadMappings(/*# string */ $class)
    {
        // mapping status changed ?
        if (self::isStatusUpdated()) {
            self::resetMappings();
            self::setStatus(false);
        }

        // $class' mapping loaded already
        if ($class::hasMappings()) {
            return;
        }

        // load $class mapping
        $loadedClass = $class::hasLoader(true);
        if ($loadedClass) {
            // loader found
            $class::setMappings(
                $loadedClass::getLoader()->loadMessages($class),
                false
            );
        } else {
            // empty cache
            $class::setMappings([], false);
        }
    }
}
