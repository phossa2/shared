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
    protected static function readFromFile($path)
    {
        $data = @simplexml_load_file($path);
        return $data ? @json_decode(json_encode($data), true) : false;
    }

    /**
     * {@inheritDoc}
     */
    protected static function getError(/*# string */ $path)/*#: string */
    {
        libxml_use_internal_errors(true);
        simplexml_load_file($path, null, \LIBXML_NOERROR);
        return libxml_get_errors()[0]->message;
    }
}
