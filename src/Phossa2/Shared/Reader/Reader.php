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

namespace Phossa2\Shared\Reader;

use Phossa2\Shared\Message\Message;
use Phossa2\Shared\Base\StaticAbstract;
use Phossa2\Shared\Exception\RuntimeException;

/**
 * Reader
 *
 * Read from file base on the suffix
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.16
 * @since   2.0.2 added
 * @since   2.0.16 updated
 */
class Reader extends StaticAbstract
{
    /**
     * supported types
     *
     * @var    string[]
     * @access protected
     * @staticvar
     */
    protected static $supported = ['ini', 'json', 'php', 'xml', 'serialized'];

    /**
     * Read, parse & return contents from the $path
     *
     * @param  string $path
     * @param  string $type force this type
     * @return mixed
     * @throws NotFoundException if $path not found
     * @throws RuntimeException if something goes wrong
     * @access public
     * @since  2.0.16 added $type param
     * @static
     */
    public static function readFile(
        /*# string */ $path,
        /*# string */ $type = ''
    ) {
        $suffix = $type ?: substr($path, strpos($path, '.') + 1);

        if (!static::isSupported($suffix)) {
            throw new RuntimeException(
                Message::get(Message::MSG_PATH_TYPE_UNKNOWN, $suffix),
                Message::MSG_PATH_TYPE_UNKNOWN
            );
        }

        /* @var ReaderInterface $class */
        $class = static::getNameSpace() . '\\' . ucfirst($suffix) . 'Reader';

        return $class::readFile($path);
    }

    /**
     * Is this type supported
     *
     * @param  string $type
     * @return bool
     * @access public
     * @static
     */
    public static function isSupported(/*# string */ $type)/*# : bool */
    {
        return in_array($type, static::$supported);
    }
}
