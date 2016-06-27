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
 * @version 2.0.8
 * @since   2.0.0 added
 */
class Message extends MessageAbstract
{
    /*
     * Class "%s" not found
     */
    const MSG_CLASS_NOTFOUND = 1606161030;

    /*
     * Static class "%s" not instantiable
     */
    const MSG_CLASS_STATIC = 1606161031;

    /*
     * Path "%s" not found
     */
    const MSG_PATH_NOTFOUND = 1606161040;

    /*
     * Path "%s" not readable
     */
    const MSG_PATH_NONREADABLE = 1606161041;

    /*
     * Path "%s" not writable
     */
    const MSG_PATH_NONWRITABLE = 1606161042;

    /*
     * Path type "%s" unknown
     */
    const MSG_PATH_TYPE_UNKNOWN = 1606161043;

    /*
     * Malformed reference "%s" found
     */
    const MSG_REF_MALFORMED = 1606161050;

    /*
     * Looped reference "%s" found
     */
    const MSG_REF_LOOP = 1606161051;

    /*
     * Delegator not found for "%s"
     */
    const MSG_DELEGATOR_UNKNOWN = 1606161060;

    /*
     * Invalid argument "%s", expecting "%s"
     */
    const MSG_ARGUMENT_INVALID = 1606161070;

    /**
     * {@inheritDoc}
     */
    protected static $messages = [
        self::MSG_CLASS_NOTFOUND => 'Class "%s" not found',
        self::MSG_CLASS_STATIC => 'Static class "%s" not instantiable',
        self::MSG_PATH_NOTFOUND => 'Path "%s" not found',
        self::MSG_PATH_NONREADABLE => 'Path "%s" not readable',
        self::MSG_PATH_NONWRITABLE => 'Path "%s" not writable',
        self::MSG_PATH_TYPE_UNKNOWN => 'Path type "%s" unknown',
        self::MSG_REF_MALFORMED => 'Malformed reference "%s" found',
        self::MSG_REF_LOOP => 'Looped reference "%s" found',
        self::MSG_DELEGATOR_UNKNOWN => 'Delegator not found for "%s"',
        self::MSG_ARGUMENT_INVALID => 'Invalid argument "%s", expecting "%s"',
    ];
}
