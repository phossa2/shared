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

namespace Phossa2\Shared\Aware;

/**
 * TagAwareTrait
 *
 * One implementation of TagAwareInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     TagAwareInterface
 * @version 2.0.0
 * @since   2.0.0 added
 */
trait TagAwareTrait
{
    /**
     * associate array (for speed consideration) of tags
     *
     * @var    array
     * @access private
     */
    private $tags = [];

    /**
     * Add a single tag
     *
     * @param  string $tag
     * @return $this
     * @access public
     * @api
     */
    public function addTag(/*# string */ $tag)
    {
        $this->tags[(string) $tag] = true;
        return $this;
    }

    /**
     * Has this tag ?
     *
     * @param  string $tag
     * @return bool
     * @access public
     * @api
     */
    public function hasTag(/*# string */ $tag)/*# : bool */
    {
        return isset($this->tags[(string) $tag]);
    }

    /**
     * Remove one tag
     *
     * @param  string $tag
     * @return $this
     * @access public
     * @api
     */
    public function removeTag(/*# string */ $tag)
    {
        unset($this->tags[(string) $tag]);
        return $this;
    }

    /**
     * Set/replace all tags, empty array to clear all tags
     *
     * @param  array $tags like ['apple', 'orange']
     * @return $this
     * @access public
     * @api
     */
    public function setTags(array $tags)
    {
        $this->tags = array_flip($tags);
        return $this;
    }

    /**
     * Get all tags in array
     *
     * @return array
     * @access public
     * @api
     */
    public function getTags()/*# : array */
    {
        return array_keys($this->tags);
    }

    /**
     * Return array of tags existed, return empty [] if no match found
     *
     * @param  array $tags tags to match against
     * @return array
     * @access public
     * @api
     */
    public function hasTags(array $tags)/*# : array */
    {
        $x = [];
        foreach ($tags as $tag) {
            if ($this->hasTag($tag)) {
                $x[] = $tag;
            }
        }
        return $x;
    }
}
