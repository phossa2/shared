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
 * ClassNameInterface
 *
 * Provides methods related to classname, namespace etc.
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.0
 * @since   2.0.0 added
 */
interface ClassNameInterface
{
    /**
     * Returns fully qualified class name
     *
     * @return string
     * @access public
     * @api
     */
    public static function getClassName()/*# : string */;

    /**
     * Returns class name without namespace
     *
     * @return string
     * @access public
     * @api
     */
    public static function getShortName()/*# : string */;

    /**
     * Returns namespace of current class
     *
     * @return string
     * @access public
     * @api
     */
    public static function getNameSpace()/*# : string */;
}
