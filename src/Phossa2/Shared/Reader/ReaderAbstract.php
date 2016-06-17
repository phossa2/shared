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
use Phossa2\Shared\Exception\NotFoundException;

/**
 * ReaderAbstract
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.1
 * @since   2.0.1 added
 */
abstract class ReaderAbstract extends StaticAbstract implements ReaderInterface
{
    /**
     * Check path existance & readability
     *
     * @param  string $path
     * @throws NotFoundException if $path not found
     * @throws RuntimeException if $path not readable
     * @access protected
     * @static
     */
    protected static function checkPath(/*# string */ $path)
    {
        if (!file_exists($path)) {
            throw new NotFoundException(
                Message::get(Message::MSG_PATH_NOTFOUND, $path),
                Message::MSG_PATH_NOTFOUND
            );
        }

        if (!is_readable($path)) {
            throw new RuntimeException(
                Message::get(Message::MSG_PATH_NONREADABLE, $path),
                Message::MSG_PATH_NONREADABLE
            );
        }
    }
}
