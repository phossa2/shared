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

namespace Phossa2\Shared\Exception;

/**
 * Phossa2 BadMethodCallException
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     \BadMethodCallException
 * @see     ExceptionInterface
 * @version 2.0.0
 * @since   2.0.0 added
 */
class BadMethodCallException extends \BadMethodCallException implements ExceptionInterface
{
}
