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

namespace Phossa2\Shared\Delegator;

/**
 * DelegatorTrait
 *
 * Implementation of DelegatorInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     DelegatorInterface
 * @version 2.0.16
 * @since   2.0.8  added
 * @since   2.0.15 modified, moved to new namespace
 * @since   2.0.16 added clearLookupCache()
 */
trait DelegatorTrait
{
    /**
     * lookup pool of registries
     *
     * @var    array
     * @access protected
     */
    protected $lookup_pool = [];

    /**
     * cached found key
     *
     * @var    string
     * @access private
     */
    private $cache_key;

    /**
     * cached lookup registry for found $cache_key
     *
     * @var    object
     * @access private
     */
    private $cache_reg;

    /**
     * Append one registry to lookup pool
     *
     * @param  object $registry
     * @return $this
     * @access protected
     */
    protected function addRegistry($registry)
    {
        // remove it if exists already
        $this->removeFromLookup($registry);

        // set delegator in registry
        if ($registry instanceof DelegatorAwareInterface) {
            $registry->setDelegator($this);
        }

        // append to the pool
        $this->lookup_pool[] = $registry;

        return $this;
    }

    /**
     * check existence in the whole lookup pool
     *
     * @param  string $key
     * @return bool
     * @access protected
     */
    protected function hasInLookup(/*# string */ $key)/*# : bool */
    {
        foreach ($this->lookup_pool as $registry) {
            if ($this->hasInRegistry($registry, $key)) {
                $this->cache_key = $key;
                $this->cache_reg = $registry;
                return true;
            }
        }
        return false;
    }

    /**
     * get from lookup pool, return NULL if not found
     *
     * @param  string $key
     * @return mixed|null
     * @access protected
     */
    protected function getFromLookup(/*# string */ $key)
    {
        // found already ? or try find
        if ($key === $this->cache_key || $this->hasInLookup($key)) {
            return $this->getFromRegistry($this->cache_reg, $key);
        }
        // not found
        return null;
    }

    /**
     * Remove one registry from the pool
     *
     * @param  object $registry
     * @return $this
     * @access protected
     */
    protected function removeFromLookup($registry)
    {
        foreach ($this->lookup_pool as $idx => $reg) {
            if ($registry === $reg) {
                if ($reg instanceof DelegatorAwareInterface) {
                    $reg->setDelegator();
                }
                unset($this->lookup_pool[$idx]);
            }
        }
        return $this;
    }

    /**
     * Clear lookup cache
     *
     * @access protected
     */
    protected function clearLookupCache()
    {
        $this->cache_key = null;
    }

    /**
     * Try HAS in registry
     *
     * @param  object $registry
     * @param  string $key
     * @return bool
     * @access protected
     */
    abstract protected function hasInRegistry(
        $registry,
        /*# string */ $key
    )/*# : bool */;

    /**
     * Try GET from registry
     *
     * @param  object $registry
     * @param  string $key
     * @return mixed|null
     * @access protected
     */
    abstract protected function getFromRegistry(
        $registry,
        /*# string */ $key
    );
}
