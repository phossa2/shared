<?php
/**
 * Phossa Project
 *
 * PHP version 5.4
 *
 * @category  Library
 * @package   Phossa2\Share
 * @copyright Copyright (c) 2016 phossa.com
 * @license   http://mit-license.org/ MIT License
 * @link      http://www.phossa.com/
 */
/*# declare(strict_types=1); */

namespace Phossa2\Shared\Attribute;

/**
 * AttributeInterface
 *
 * Set/get attributes of objects.
 *
 * - Usually a set of static attributes defined for the class which are
 *   shared among all sibling classes.
 *
 * - Sibling classes can add their own attributes to the static attrs
 *
 * - Instance attributes can be passed into objects by the constructor
 *
 * ```php
 * class Student implement AttributeInterface
 * {
 *     use StaticVarTrait; // methods to dealing with class static var
 *
 *     // class-level default attribues
 *     protected static $default_attributes = [
 *         'gender' => 'male',
 *         'age'  => 12
 *     ];
 *
 *     // instance attributes
 *     protected $attributes = [];
 *
 *     public function __construct(array $attrs)
 *     {
 *         $this->setAttributes(
 *             $this->initStaticVar($attrs, 'default_attributes')
 *         );
 *     }
 *
 *     public function setAttributes()
 *     {
 *          ...
 *     }
 *     ...
 * }
 *
 * // able to modify attributes in subclass' definition
 * class FemaleStudent extends Student {
 *     protected static $default_attributes = [
 *         'gender' => 'female'
 *     ];
 * }
 *
 * // able to modify instance attributes with constructor parameter
 * $female = new FemaleStudent([]);
 *
 * // ['gender' => 'female', 'age' => 12]
 * var_dump($female->getAttributes());
 * ```
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.28
 * @since   2.0.28 added
 */
interface AttributeInterface
{
    /**
     * Set a specific instance attribute
     *
     * @param  string $attrName
     * @param  mixed $attrValue
     * @return $this
     * @access public
     * @api
     */
    public function setAttribute(/*# string */ $attrName, $attrValue);

    /**
     * Append $attrValue to the end of attribute (array)
     *
     * @param  string $attrName
     * @param  mixed $attrValue
     * @return $this
     * @access public
     * @api
     */
    public function addAttribute(/*# string */ $attrName, $attrValue);

    /**
     * Get a specific attribute, returns NULL if not found
     *
     * @param  string $attrName
     * @return mixed
     * @access public
     * @api
     */
    public function getAttribute(/*# string */ $attrName);

    /**
     * Set/replace the whole attributes of the object
     *
     * @param  array $attributes
     * @return $this
     * @access public
     */
    public function setAttributes(array $attributes);

    /**
     * Get all attributes of the object
     *
     * @return array
     * @access public
     */
    public function getAttributes()/*# : array */;
}
