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

namespace Phossa2\Shared\Base;

use Phossa2\Shared\Message\Message;

/**
 * ClassNameTrait
 *
 * - Implementation of ClassNameInterface.
 * - Provides PHP 5.5 ::class feature for classes using this trait
 * - methods are final to prevent accidental overriden in child class
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.0
 * @since   2.0.0 added
 * @since   2.0.24 added setProperties()
 * @since   2.0.29 modified getShortName(), getNamespace() parameters
 */
trait ClassNameTrait
{
    /**
     * Returns fully qualified class name
     *
     * @return string
     * @access public
     * @final
     * @api
     */
    final public static function getClassName()/*# : string */
    {
        return get_called_class();
    }

    /**
     * Returns class name without namespace
     *
     * @param  string|object $className optional classname
     * @return string
     * @access public
     * @since  2.0.29 add $className parameter
     * @final
     * @api
     */
    final public static function getShortName(
        $className = ''
    )/*# : string */ {
        return substr(strrchr(static::getRealClassName($className), '\\'), 1);
    }

    /**
     * Returns namespace of current class
     *
     * @param  string|object $className optional classname
     * @return string
     * @access public
     * @since  2.0.29 add $className parameter
     * @final
     * @api
     */
    final public static function getNameSpace(
        /*# string */ $className = ''
    )/*# : string */ {
        $class = static::getRealClassName($className);
        return substr($class, 0, strrpos($class, '\\'));
    }

    /**
     * Set object properties
     *
     * @param  array $properties
     * @access public
     * @since  2.0.24 added
     * @api
     */
    final public function setProperties(array $properties = [])
    {
        foreach ($properties as $name => $value) {
            if (property_exists($this, $name)) {
                $this->$name = $value;
            } else {
                trigger_error(
                    Message::get(
                        Message::MSG_PROPERTY_UNKNOWN,
                        $name,
                        get_class($this)
                    ),
                    E_USER_WARNING
                );
            }
        }
    }

    /**
     * Get the classname
     *
     * @param  string|object $className
     * @return string the class name
     * @access protected
     */
    protected static function getRealClassName($className)/*# : string */
    {
        if (is_object($className)) {
            $class = get_class($className);
        } else {
            $class = $className ?: get_called_class();
        }
        return $class;
    }
}
