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

namespace Phossa2\Shared\Reference;

use Phossa2\Shared\Message\Message;
use Phossa2\Shared\Exception\InvalidArgumentException;

/**
 * DelegatorTrait
 *
 * Implementation of DelegatorInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     DelegatorInterface
 * @version 2.0.8
 * @since   2.0.8 added
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
     * cached lookup key
     *
     * @var    string
     * @access private
     */
    private $cache_key;

    /**
     * cached lookup registry
     *
     * @var    object
     * @access private
     */
    private $cache_reg;

    /**
     * {@inheritDoc}
     */
    public function addRegistry($registry)
    {
        /* @var $registry DelegatorAwareInterface */

        // check registry type
        if (!$this->isValidRegistry($registry)) {
            throw new InvalidArgumentException(
                Message::get(Message::MSG_ARGUMENT_INVALID, get_class($registry)),
                Message::MSG_ARGUMENT_INVALID
            );
        }
        // register delegator
        $registry->setDelegator($this);

        // remove this registry if exists already
        $this->removeFromLookup($registry);

        // append to the pool end
        $this->lookup_pool[] = $registry;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hasInLookup(/*# string */ $key)/*# : bool */
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
     * {@inheritDoc}
     */
    public function getFromLookup(/*# string */ $key)
    {
        // lookup already ? try lookup first
        if ($key === $this->cache_key || $this->hasInLookup($key)) {
            return $this->getFromRegistry($this->cache_reg, $key);
        }
        // not found
        return null;
    }

    /**
     * Remove one object from the pool
     *
     * @param  object $registry
     * @return $this
     * @access protected
     */
    protected function removeFromLookup($registry)
    {
        foreach ($this->lookup_pool as $idx => $reg) {
            if ($registry === $reg) {
                unset($this->lookup_pool[$idx]);
            }
        }
        return $this;
    }

    /**
     * Is registry type allowed in lookup pool ?
     *
     * @param  object $registry
     * @return bool
     * @access protected
     */
    abstract protected function isValidRegistry($registry)/*# : bool */;

    /**
     * Try has in registry
     *
     * @param  object $registry
     * @param  name $key
     * @return bool
     * @access protected
     */
    abstract protected function hasInRegistry(
        $registry,
        /*# string */ $key
    )/*# : bool */;

    /**
     * Try get from registry
     *
     * @param  object $registry
     * @param  name $key
     * @return mixed
     * @access protected
     */
    abstract protected function getFromRegistry(
        $registry,
        /*# string */ $key
    );
}
