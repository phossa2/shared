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
use Phossa2\Shared\Exception\NotFoundException;

/**
 * ReaderInterface
 *
 * Read different format php|ini|json|xml files
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.1
 * @since   2.0.1 added
 */
interface ReaderInterface
{
    /**
     * Read, parse & return contents from the $path
     *
     * @param  string $path
     * @return mixed
     * @throws NotFoundException if $path not found
     * @throws RuntimeException if something goes wrong
     * @access public
     * @static
     */
    public static function readFile(/*# string */ $path);
}
