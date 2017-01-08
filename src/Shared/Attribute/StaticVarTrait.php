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

namespace Phossa2\Shared\Attribute;

/**
 * StaticVarTrait
 *
 * Dealing with class' static array variable
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.28
 * @since   2.0.28 added
 */
trait StaticVarTrait
{
    /**
     * Get MERGED/REPLACED static variable for CURRENT class
     *
     * @param  string $staticVarName static variable name
     * @return array
     * @access protected
     * @static
     */
    protected static function getStaticVar($staticVarName)/*# : array */
    {
        $class = get_called_class();
        $parent = get_parent_class($class);

        // get current class' static variable
        $res = $class::${$staticVarName};

        // merge with ancestor class' same static variable
        if ($parent) {
            $res = $parent::getStaticVar($staticVarName);
            if ($class::${$staticVarName} != $parent::${$staticVarName}) {
                $res = array_replace_recursive($res, $class::${$staticVarName});
            }
        }

        return $res;
    }

    /**
     * Merge/replace static var with given array of values
     *
     * @param  array $var given values
     * @param  string $staticVarName static variable name
     * @return array
     * @access protected
     */
    protected function initStaticVar(
        array $var,
        /*# string */ $staticVarName
    )/*# : array */ {
        return array_replace_recursive(
            static::getStaticVar($staticVarName),
            $var
        );
    }
}
