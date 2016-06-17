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
 * @version 2.0.1
 * @since   2.0.0 added
 */
class Message extends MessageAbstract
{
    /*
     * Class "%s" not found
     */
    const MSG_CLASS_NOTFOUND    = 1606161030;

    /*
     * Static class "%s" not instantiable
     */
    const MSG_CLASS_STATIC      = 1606161031;

    /*
     * Path "%s" not found
     */
    const MSG_PATH_NOTFOUND     = 1606161040;

    /*
     * Path "%s" not readable
     */
    const MSG_PATH_NONREADABLE  = 1606161041;

    /*
     * Path "%s" not writable
     */
    const MSG_PATH_NONWRITABLE  = 1606161042;

    /**
     * {@inheritDoc}
     */
    protected static $messages = [
        self::MSG_CLASS_NOTFOUND    => 'Class "%s" not found',
        self::MSG_CLASS_STATIC      => 'Static class "%s" not instantiable',
        self::MSG_PATH_NOTFOUND     => 'Path "%s" not found',
        self::MSG_PATH_NONREADABLE  => 'Path "%s" not readable',
        self::MSG_PATH_NONWRITABLE  => 'Path "%s" not writable',
    ];
}