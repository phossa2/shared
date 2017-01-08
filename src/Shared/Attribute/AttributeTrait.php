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
 * AttributeTrait
 *
 * Implementation of AttributeInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     AttributeInterface
 * @version 2.0.28
 * @since   2.0.28 added
 */
trait AttributeTrait
{
    use StaticVarTrait; // methods dealing with class static attributes

    /**
     * Instance attributes
     *
     * @var    array
     * @access protected
     */
    protected $attributes = [];

    /**
     * {@inheritDoc}
     */
    public function setAttribute(/*# string */ $attrName, $attrValue)
    {
        $this->attributes[$attrName] = $attrValue;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function addAttribute(/*# string */ $attrName, $attrValue)
    {
        if (!is_array($this->attributes[$attrName])) {
            $this->attributes[$attrName] = (array) $this->attributes[$attrName];
        }
        $this->attributes[$attrName][] = $attrValue;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getAttribute(/*# string */ $attrName)
    {
        if (isset($this->attributes[(string) $attrName])) {
            return $this->attributes[(string) $attrName];
        }
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getAttributes()/*# : array */
    {
        return $this->attributes;
    }
}
