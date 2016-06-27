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

namespace Phossa2\Shared\Cache;

/**
 * LocalCacheTrait
 *
 * Provides a local/class level cache support
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.8
 * @since   2.0.8 added
 */
trait LocalCacheTrait
{
    /**
     * a local cache
     *
     * @var    array
     * @access private
     */
    private $local_cache = [];

    /**
     * Clear local cache
     *
     * @return $this
     * @access protected
     */
    protected function clearLocalCache()
    {
        $this->local_cache = [];
        return $this;
    }

    /**
     * has cached ?
     *
     * @param  string $name
     * @return bool
     * @access protected
     */
    protected function hasLocalCache(/*# strign */ $name)/*# : bool */
    {
        return isset($this->local_cache[$name]);
    }

    /**
     * get the cached value
     *
     * @param  string $name
     * @return mixed
     * @access protected
     */
    protected function getLocalCache(/*# strign */ $name)
    {
        return $this->local_cache[$name];
    }

    /**
     * set the cache
     *
     * @param  string $name
     * @param  mixed $value
     * @return $this
     * @access protected
     */
    protected function setLocalCache(/*# strign */ $name, $value)
    {
        $this->local_cache[$name] = $value;
        return $this;
    }
}
