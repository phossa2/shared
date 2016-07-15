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

use Phossa2\Shared\Message\Message;
use Phossa2\Shared\Exception\NotFoundException;

/**
 * DelegatorAwareTrait
 *
 * Implmentation of DelegatorAwareInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     DelegatorAwareInterface
 * @version 2.0.8
 * @since   2.0.8  added
 * @since   2.0.15 moved to new namespace
 */
trait DelegatorAwareTrait
{
    /**
     * the delegator
     *
     * @var    DelegatorInterface
     * @access protected
     */
    protected $delegator;

    /**
     * {@inheritDoc}
     */
    public function setDelegator(DelegatorInterface $delegator)
    {
        $this->delegator = $delegator;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hasDelegator()/*# : bool */
    {
        return null !== $this->delegator;
    }

    /**
     * {@inheritDoc}
     */
    public function getDelegator()/*# : DelegatorInterface */
    {
        if ($this->hasDelegator()) {
            return $this->delegator;
        }

        throw new NotFoundException(
            Message::get(Message::MSG_DELEGATOR_UNKNOWN, get_called_class()),
            Message::MSG_DELEGATOR_UNKNOWN
        );
    }
}
