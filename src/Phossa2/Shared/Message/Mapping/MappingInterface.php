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

namespace Phossa2\Shared\Message\Mapping;

/**
 * MappingInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.0
 * @since   2.0.0 added
 */
interface MappingInterface
{
    /**
     * Reset current message class' code to message mappings cache
     *
     * ```php
     *     MyMessage::setMappings([
     *         MyMessage::MSG_HELLO => 'Hello %s'
     *     ]);
     * ```
     *
     * @param  array $messages messages mapping array
     * @param  bool $manual manually, not auto load from $loader
     * @access public
     * @api
     */
    public static function setMappings(
        array $messages,
        /*# bool */ $manual = true
    );
}
