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

namespace Phossa2\Shared\String;

/**
 * ConversionTrait
 *
 * String conversion utilities
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.28
 * @since   2.0.28 added
 */
trait ConversionTrait
{
    /**
     * Convert case of a string.
     *
     * Supported $toCase are
     *
     * 'PASCAL': PascalCase
     * 'CAMEL' : camelCase
     * 'SNAKE' : snake_case
     *
     * @param  string $string
     * @param  string $toCase
     * @return string
     * @access public
     * @static
     */
    public static function convertCase(
        /*# string */ $string,
        /*# string */ $toCase
    )/*# string */ {
        // break into lower case words
        $str = strtolower(ltrim(
            preg_replace(['/[A-Z]/', '/[_]/'], [' $0', ' '], $string)
        ));

        switch (strtoupper($toCase)) {
            case 'PASCAL':
                return str_replace(' ', '', ucwords($str));
            case 'CAMEL' :
                return lcfirst(str_replace(' ', '', ucwords($str)));
            default: // SNAKE
                return str_replace(' ', '_', $str);
        }
    }

    /**
     * Has string contain a suffix ?
     *
     * @param  string $string
     * @param  string $suffix
     * @return bool
     * @access public
     * @static
     */
    public static function hasSuffix(
        /*# string */ $string,
        /*# string */ $suffix
    )/*# : bool */ {
        $len = strlen($suffix);
        if ($len && substr($string, - $len) === $suffix) {
            return true;
        }
        return false;
    }

    /**
     * Remove a suffix from a string
     *
     * @param  string $string
     * @param  string $suffix
     * @return string
     * @access public
     * @static
     */
    public static function removeSuffix(
        /*# string */ $string,
        /*# string */ $suffix
    )/*# string */ {
        if (static::hasSuffix($string, $suffix)) {
            return substr($string, 0, - strlen($suffix));
        }
        return $string;
    }
}
