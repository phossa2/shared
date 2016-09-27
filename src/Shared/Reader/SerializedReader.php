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
    protected static function readFromFile($path)
    {
        return @unserialize(file_get_contents($path));
    }
}
