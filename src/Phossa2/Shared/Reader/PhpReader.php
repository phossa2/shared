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
 * Read & parse php formatted file and return the result
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.1
 * @since   2.0.1 added
 */
class PhpReader extends ReaderAbstract
{
    /**
     * {@inheritDoc}
     */
    protected static function readFromFile($path)
    {
        try {
            return include $path;
        } catch (\Exception $exception) {
            throw new RuntimeException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}
