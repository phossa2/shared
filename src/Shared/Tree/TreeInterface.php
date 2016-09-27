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

namespace Phossa2\Shared\Tree;

/**
 * TreeInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.5
 * @since   2.0.5 added
 */
interface TreeInterface
{
    /**
     * return the whole tree
     *
     * @return array
     * @access public
     * @api
     */
    public function getTree()/*# : array */;

    /**
     * Get one node, NULL if not found
     *
     * @param  string $nodeName
     * @return mixed
     * @access public
     * @api
     */
    public function &getNode(/*# string */ $nodeName);

    /**
     * Has node in tree or not
     *
     * @param  string $nodeName
     * @return bool
     * @access public
     * @api
     */
    public function hasNode(/*# string */ $nodeName)/*# : bool */;

    /**
     * Add one node
     *
     * @param  string $nodeName
     * @param  mixed $data
     * @return $this
     * @access public
     * @api
     */
    public function addNode(/*# string */ $nodeName, $data);

    /**
     * Delete one node if exists
     *
     * @param  string $nodeName
     * @return $this
     * @access public
     * @since  2.0.5
     * @api
     */
    public function deleteNode(/*# string */ $nodeName);

    /**
     * Get field delimiter
     *
     * @return string
     * @access public
     * @api
     */
    public function getDelimiter()/*# : string */;
}
