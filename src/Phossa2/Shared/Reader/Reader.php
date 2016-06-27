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
 * @version 2.0.2
 * @since   2.0.2 added
 */
class Reader extends StaticAbstract implements ReaderInterface
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
     * {@inheritDoc}
     */
    public static function readFile(/*# string */ $path)
    {
        $suffix = substr($path, strpos($path, '.') + 1);

        if (!static::isSupported($suffix)) {
            throw new RuntimeException(
                Message::get(Message::MSG_PATH_TYPE_UNKNOWN, $suffix),
                Message::MSG_PATH_TYPE_UNKNOWN
            );
        }

        /* @var ReaderInterface $class */
        $class  = static::getNameSpace() . '\\' . ucfirst($suffix) . 'Reader';

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
