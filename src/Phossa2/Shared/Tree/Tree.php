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
 * @see     ObjectAbstract
 * @see     TreeInterface
 * @version 2.0.6
 * @since   2.0.3 added
 * @since   2.0.5 added deleteNode(), using TreeInterface
 */
class Tree extends ObjectAbstract implements TreeInterface
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
     * @api
     */
    public function __construct(array $data = [], /*# string */ $splitter = '.')
    {
        $this->splitter = $splitter;
        $this->tree = $this->fixTree($data);
    }

    /**
     * {@inheritDoc}
     */
    public function getTree()/*# : array */
    {
        return $this->tree;
    }

    /**
     * {@inheritDoc}
     */
    public function &getNode(/*# string */ $nodeName)
    {
        if ('' === $nodeName) {
            $result = &$this->tree;
        } else {
            $result = &$this->searchNode($nodeName, $this->tree, false);
        }
        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function hasNode(/*# string */ $nodeName)/*# : bool */
    {
        if (null === $this->getNode($nodeName)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addNode(/*# string */ $nodeName, $data)
    {
        $node = &$this->searchNode($nodeName, $this->tree, true);
        $node = $this->fixTree($data);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteNode(/*# string */ $nodeName)
    {
        if ('' === $nodeName) {
            $this->tree = [];
        } else {
            $current = &$this->getNode($nodeName);
            if (null !== $current) {
                $split = explode($this->splitter, $nodeName);
                $name  = array_pop($split);
                $upper = &$this->getNode(join($this->splitter, $split));
                unset($upper[$name]);
            }
        }
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDelimiter()/*# : string */
    {
        return $this->splitter;
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
            $res = is_array($v) ? $this->fixTree($v) : $v;
        }
        return $result;
    }

    /**
     * Search a node in the $data
     *
     * @param  string $key
     * @param  array &$data
     * @param  bool $create
     * @access protected
     * @since  2.0.6 bug fix
     */
    protected function &searchNode(
        /*# string */ $key,
        array &$data,
        /*# bool */ $create = true
    ) {
        $found = &$data;
        foreach (explode($this->splitter, $key) as $k) {
            if (is_array($found) && isset($found[$k])) {
                $found = &$found[$k];
            } elseif (is_array($found) && $create) {
                $found[$k] = [];
                $found = &$found[$k];
            } else {
                $val = null;
                return $val;
            }
        }
        return $found;
    }
}
