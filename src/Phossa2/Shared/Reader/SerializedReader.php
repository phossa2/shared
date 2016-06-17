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
 * Read serialized formatted content from file
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.1
 * @since   2.0.1 added
 */
class SerializedReader extends ReaderAbstract
{
    /**
     * {@inheritDoc}
     */
    public static function readFile(/*# string */ $path)
    {
        // check first
        static::checkPath($path);

        // read
        $data = @unserialize(file_get_contents($path));

        if (false === $data) {
            $error = error_get_last();
            throw new RuntimeException($error['message']);
        }

        return $data;
    }
}
