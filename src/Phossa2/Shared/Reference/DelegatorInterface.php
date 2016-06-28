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

use Phossa2\Shared\Exception\InvalidArgumentException;

/**
 * DelegatorInterface
 *
 * Reference lookup delegation
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.8
 * @since   2.0.8 added
 */
interface DelegatorInterface
{
    /**
     * Append one registry to lookup pool
     *
     * @param  object $registry
     * @return $this
     * @throws InvalidArgumentException if $registry not the right type
     * @access public
     * @api
     */
    public function addRegistry($registry);

    /**
     * check reference existence in the whole lookup pool
     *
     * @param  string $key
     * @return bool
     * @access public
     * @api
     */
    public function hasInLookup(/*# string */ $key)/*# : bool */;

    /**
     * get reference from lookup pool, return NULL if not found
     *
     * @param  string $key
     * @return mixed
     * @access public
     * @api
     */
    public function getFromLookup(/*# string */ $key);
}
