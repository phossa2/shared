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

use Phossa2\Shared\Base\ObjectAbstract;

/**
 * Dealing with tree structure
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.3
 * @since   2.0.3 added
 */
class Tree extends ObjectAbstract
{
    /**
     * node splitter
     *
     * @var    string
     * @access protected
     */
    protected $splitter = '.';

    /**
     * the result tree
     *
     * @var    array
     * @access protected
     */
    protected $tree;

    /**
     * construct a tree
     *
     * @param  array $data
     * @param  string $splitter
     * @access public
     */
    public function __construct(array $data, /*# string */ $splitter = '.')
    {
        $this->splitter = $splitter;
        $this->tree = $this->fixTree($data);
    }

    /**
     * return the whole tree
     *
     * @return array
     * @access public
     */
    public function getTree()/*# : array */
    {
        return $this->tree;
    }

    /**
     * Get one node, NULL if not found
     *
     * @param  string $nodeName
     * @return mixed
     * @access public
     */
    public function getNode(/*# string */ $nodeName)
    {
        $result = &$this->searchNode($nodeName, $this->tree, false);
        return $result;
    }

    /**
     * Fix array, convert flat name to tree node name
     *
     * @param  array $data
     * @return array
     * @access protected
     */
    protected function fixTree(array $data)/*# : array */
    {
        $result = [];
        foreach ($data as $k => $v) {
            $res = &$this->searchNode($k, $result);
            $res = is_array($v) ? $this->fixValue($v) : $v;
        }
        return $result;
    }

    /**
     * Search a node in the $data
     *
     * @param  string $key
     * @param  array &$data
     * @param  bool $create create the node if not exist
     * @access protected
     */
    protected function &searchNode(
        /*# string */ $key,
        array &$data,
        /*# bool */ $create = true
    ) {
        $found = &$data;
        foreach (explode($this->splitter, $key) as $k) {
            if (isset($found[$k])) {
                $found = &$found[$k];
            } elseif ($create) {
                $found[$k] = [];
                $found = &$found[$k];
            } else {
                $found = null;
                break;
            }
        }
        return $found;
    }
}
