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
     * lookup pool of containers
     *
     * @var    array
     * @access private
     */
    private $lookup_pool = [];

    /**
     * cached lookup key
     *
     * @var    string
     * @access private
     */
    private $cache_key;

    /**
     * cached lookup container
     *
     * @var    object
     * @access private
     */
    private $cache_obj;

    /**
     * {@inheritDoc}
     */
    public function addContainer($container)
    {
        if ($this->isValidContainer($container)) {
            // remove container if exists already
            $this->removeFromLookup($container);

            // append to the pool end
            $this->lookup_pool[] = $container;

            return $this;
        }

        throw new InvalidArgumentException(
            Message::get(Message::MSG_ARGUMENT_INVALID, get_class($container)),
            Message::MSG_ARGUMENT_INVALID
        );
    }

    /**
     * {@inheritDoc}
     */
    public function hasInLookup(/*# string */ $key)/*# : bool */
    {
        foreach ($this->lookup_pool as $container) {
            if ($this->hasInContainer($container, $key)) {
                $this->cache_key = $key;
                $this->cache_obj = $container;
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
        // check cache first
        if ($key === $this->cache_key) {
            return $this->getFromContainer($this->cache_obj, $key);
        }

        // try lookup
        if ($this->hasInLookup($key)) {
            return $this->getFromContainer($this->cache_obj, $key);
        }

        // not found
        return null;
    }

    /**
     * Remove one object from the pool
     *
     * @param  object $container
     * @return $this
     * @access protected
     */
    protected function removeFromLookup($container)
    {
        foreach ($this->lookup_pool as $idx => $obj) {
            if ($container === $obj) {
                unset($this->lookup_pool[$idx]);
            }
        }
        return $this;
    }

    /**
     * Is container type allowed in lookup pool ?
     *
     * @param  object $container
     * @return bool
     * @access protected
     */
    abstract protected function isValidContainer($container)/*# : bool */;

    /**
     * Try has in container
     *
     * @param  object $container
     * @param  name $key
     * @return bool
     * @access protected
     */
    abstract protected function hasInContainer(
        $container,
        /*# string */ $key
    )/*# : bool */;

    /**
     * Try get from container
     *
     * @param  object $container
     * @param  name $key
     * @return mixed
     * @access protected
     */
    abstract protected function getFromContainer(
        $container,
        /*# string */ $key
    );
}
