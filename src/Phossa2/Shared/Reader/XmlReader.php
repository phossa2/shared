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

use Phossa2\Shared\Exception\RuntimeException;

/**
 * Read & parse xml formatted file and return the result
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.1
 * @since   2.0.1 added
 */
class XmlReader extends ReaderAbstract
{
    /**
     * {@inheritDoc}
     */
    public static function readFile(/*# string */ $path)
    {
        // check first
        static::checkPath($path);

        // read it
        @$data = simplexml_load_file($path);

        if (false === $data) {
            libxml_use_internal_errors(true);
            simplexml_load_file($path, null, \LIBXML_NOERROR);
            $errors = libxml_get_errors();
            throw new RuntimeException($errors[0]->message);
        }

        return json_decode(json_encode($data), true);
    }
}
