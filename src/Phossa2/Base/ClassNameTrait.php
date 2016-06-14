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

namespace Phossa2\Base;

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
     * @return string
     * @access public
     * @final
     * @api
     */
    final public static function getShortName()/*# : string */
    {
        $className = static::getClassName();
        return substr($className, strrpos($className, '\\'));
    }

    /**
     * Returns namespace of current class
     *
     * @return string
     * @access public
     * @final
     * @api
     */
    final public static function getNameSpace()/*# : string */
    {
        $className = static::getClassName();
        return substr($className, 0, strrpos($className, '\\'));
    }
}
