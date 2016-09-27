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

namespace Phossa2\Shared\Base;

use Phossa2\Shared\Message\Message;
use Phossa2\Shared\Exception\RuntimeException;

/**
 * StaticTrait
 *
 * For used in a generic static class
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.0
 * @since   2.0.0 added
 */
trait StaticTrait
{
    /**
     * Finalized constructor to prevent instantiation.
     *
     * @access public
     * @final
     */
    final public function __construct()
    {
        throw new RuntimeException(
            Message::get(Message::MSG_CLASS_STATIC, get_called_class()),
            Message::MSG_CLASS_STATIC
        );
    }
}
