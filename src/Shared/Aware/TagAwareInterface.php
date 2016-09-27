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
 * TagAwareInterface
 *
 * Add tagging support
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.0
 * @since   2.0.0 added
 */
interface TagAwareInterface
{
    /**
     * Add a single tag
     *
     * @param  string $tag
     * @return $this
     * @access public
     * @api
     */
    public function addTag(/*# string */ $tag);

    /**
     * Has this tag ?
     *
     * @param  string $tag
     * @return bool
     * @access public
     * @api
     */
    public function hasTag(/*# string */ $tag)/*# : bool */;

    /**
     * Remove one tag
     *
     * @param  string $tag
     * @return $this
     * @access public
     * @api
     */
    public function removeTag(/*# string */ $tag);

    /**
     * Set/replace all tags, empty array to clear all tags
     *
     * @param  array $tags like ['apple', 'orange']
     * @return $this
     * @access public
     * @api
     */
    public function setTags(array $tags);

    /**
     * Get all tags in array
     *
     * @return array
     * @access public
     * @api
     */
    public function getTags()/*# : array */;

    /**
     * Return array of tags existed, return empty [] if no match found
     *
     * @param  array $tags tags to match against
     * @return array
     * @access public
     * @api
     */
    public function hasTags(array $tags)/*# : array */;
}
