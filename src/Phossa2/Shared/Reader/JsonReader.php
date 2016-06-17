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
 * Read & parse json formatted file and return the result
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.1
 * @since   2.0.1 added
 */
class JsonReader extends ReaderAbstract
{
    /**
     * default json error
     *
     * @var    array
     * @access protected
     * @staticvar
     */
    protected static $error = [
        \JSON_ERROR_NONE => 'No error',
        \JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
        \JSON_ERROR_STATE_MISMATCH => 'State mismatch (invalid or malformed JSON)',
        \JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
        \JSON_ERROR_SYNTAX => 'Syntax error',
        \JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded',
    ];

    /**
     * {@inheritDoc}
     */
    protected static function readFromFile($path)
    {
        return @json_decode(file_get_contents($path), true);
    }

    /**
     * {@inheritDoc}
     */
    protected static function getError(/*# string */ $path)/*#: string */
    {
        if (function_exists('json_last_error_msg')) {
            return json_last_error_msg();
        } else {
            $error = json_last_error();
            return isset(static::$error[$error]) ?
                static::$error[$error] : 'JSON parse error';
        }
    }
}
