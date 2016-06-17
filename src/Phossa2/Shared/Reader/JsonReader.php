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
use Phossa2\Shared\Exception\RuntimeException;

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
        \JSON_ERROR_RECURSION => 'Recursion found',
        \JSON_ERROR_INF_OR_NAN => 'NaN found',
        \JSON_ERROR_UNSUPPORTED_TYPE => 'Unsupported type found',
        \JSON_ERROR_INVALID_PROPERTY_NAME => 'Invalid property name found',
        \JSON_ERROR_UTF16 => 'Malformed UTF-16 characters, possibly incorrectly encoded',
    ];

    /**
     * {@inheritDoc}
     */
    public static function readFile(/*# string */ $path)
    {
        // check first
        static::checkPath($path);

        // read it
        $data  = @json_decode(file_get_contents($path), true);

        // check error if any
        $error = json_last_error();
        if ($error !== \JSON_ERROR_NONE) {
            if (function_exists('json_last_error_msg')) {
                $message = json_last_error_msg();
            } else {
                $message = isset(static::$error[$error]) ?
                    static::$error[$error] : 'Unknown JSON error';
            }
            throw new RuntimeException(Message::get($message), $error);
        }

        return $data;
    }
}
