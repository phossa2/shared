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

use Phossa2\Shared\Exception\NotFoundException;

/**
 * DelegatorAwareInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.15
 * @since   2.0.8  added
 * @since   2.0.15 moved to new namespace, allows null in setDelegator()
 * @since   2.0.17 updated getDelegator()
 */
interface DelegatorAwareInterface
{
    /**
     * Set the delegator
     *
     * @param  DelegatorInterface $delegator
     * @return $this
     * @access public
     * @since  2.0.15 delegator accepts null
     * @api
     */
    public function setDelegator(DelegatorInterface $delegator = null);

    /**
     * Has delegator set ?
     *
     * @return bool
     * @access public
     * @api
     */
    public function hasDelegator()/*# : bool */;

    /**
     * Try get the delegator (recursively)
     *
     * @param  bool $recursive
     * @return DelegatorInterface
     * @throws NotFoundException if delegator not found
     * @access public
     * @since  2.0.17 added param $recursive
     * @api
     */
    public function getDelegator(
        /*# bool */ $recursive = false
    )/*# : DelegatorInterface */;
}
