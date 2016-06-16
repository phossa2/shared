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

namespace Phossa2\Shared\Message;

/**
 * Provide some common messages
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.0
 * @since   2.0.0 added
 */
class Message extends MessageAbstract
{
    /*
     * Class "%s" not found
     */
    const MSG_CLASS_NOTFOUND    = 1606161035;

    /*
     * Static class "%s" not instantiable
     */
    const MSG_CLASS_STATIC      = 1606161036;

    /**
     * {@inheritDoc}
     */
    protected static $messages = [
        self::MSG_CLASS_NOTFOUND    => 'Class "%s" not found',
        self::MSG_CLASS_STATIC      => 'Static class "%s" not instantiable',
    ];
}
