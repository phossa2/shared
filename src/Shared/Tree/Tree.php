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
        $this->tree = empty($data) ? $data : $this->fixTree($data);
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
        // get the node
        $node = &$this->searchNode($nodeName, $this->tree);

        // fix data
        if (is_array($data)) {
            $data = $this->fixTree($data);
        }

        // merge
        if (is_array($node) && is_array($data)) {
            $node = array_replace_recursive($node, $data);
        } else {
            $node = $data;
        }

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
            if (is_array($v) && is_array($res)) {
                $res = array_replace_recursive($res, $this->fixTree($v));
            } else {
                $res = $v;
            }
        }
        return $result;
    }

    /**
     * Search a node in the $data
     *
     * @param  string $path
     * @param  array &$data
     * @param  bool $create
     * @return mixed null for not found
     * @access protected
     * @since  2.0.6 bug fix
     */
    protected function &searchNode(
        /*# string */ $path,
        array &$data,
        /*# bool */ $create = true
    ) {
        $found = &$data;
        foreach (explode($this->splitter, $path) as $k) {
            $found = &$this->childNode($k, $found, $create);
            if (null === $found) {
                break;
            }
        }
        return $found;
    }

    /**
     * get or create the next/child node, return NULL if not found
     *
     * @param  string $key
     * @param  mixed $data
     * @param  bool $create create the node if not exist
     * @return mixed
     * @access protected
     */
    protected function &childNode(
        /*# string */ $key,
        &$data,
        /*# bool */ $create
    ) {
        $null = null;
        if (is_array($data)) {
            if (isset($data[$key])) {
                return $data[$key];
            } elseif ($create) {
                $data[$key] = [];
                return $data[$key];
            }
        }
        return $null;
    }
}
