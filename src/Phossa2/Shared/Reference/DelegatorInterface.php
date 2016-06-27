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

use Phossa2\Shared\Exception\NotFoundException;

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
     * Append the object to lookup pool
     *
     * @param  object object
     * @return $this
     * @access public
     * @api
     */
    public function addToLookup($object);

    /**
     * check reference existence in lookup pool
     *
     * @param  string $key
     * @return bool
     * @access public
     * @api
     */
    public function hasInLookup(/*# string */ $key)/*# : bool */;

    /**
     * get reference from lookup pool
     *
     * @param  string $key
     * @return mixed
     * @throws NotFoundException if not found
     * @access public
     * @api
     */
    public function getFromLookup(/*# string */ $key);
}
