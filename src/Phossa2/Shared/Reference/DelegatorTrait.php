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
use Phossa2\Shared\Exception\NotFoundException;

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
     * lookup pool
     *
     * @var    array
     * @access private
     */
    private $lookup_pool = [];

    /**
     * lookup cache key
     *
     * @var    string
     * @access private
     */
    private $cache_key;

    /**
     * lookup cache object
     *
     * @var    object
     * @access private
     */
    private $cache_obj;

    /**
     * {@inheritDoc}
     */
    public function addToLookup($object)
    {
        // remove if exists already
        $this->removeFromLookup($object);

        // append to the pool end
        $this->lookup_pool[] = $object;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hasInLookup(/*# string */ $key)/*# : bool */
    {
        foreach ($this->lookup_pool as $object) {
            if ($this->hasInObject($object, $key)) {
                $this->cache_key = $key;
                $this->cache_obj = $object;
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
            return $this->getFromObject($this->cache_obj, $key);
        }

        // try lookup
        if ($this->hasInLookup($key)) {
            return $this->getFromObject($this->cache_obj, $key);
        }

        // not found
        throw new NotFoundException(
            Message::get(Message::MSG_REF_UNKNOWN, $key),
            Message::MSG_REF_UNKNOWN
        );
    }

    /**
     * Remove one object from the pool
     *
     * @param  object $object
     * @return $this
     * @access protected
     */
    protected function removeFromLookup($object)
    {
        foreach ($this->lookup_pool as $idx => $obj) {
            if ($object === $obj) {
                unset($this->lookup_pool[$idx]);
            }
        }
        return $this;
    }

    /**
     * Try has in object
     *
     * @param  object $object
     * @param  name $key
     * @return bool
     * @access protected
     */
    abstract protected function hasInObject(
        $object,
        /*# string */ $key
    )/*# : bool */;

    /**
     * Try get from object
     *
     * @param  object $object
     * @param  name $key
     * @return mixed
     * @access protected
     */
    abstract protected function getFromObject(
        $object,
        /*# string */ $key
    );
}
