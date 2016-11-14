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

namespace Phossa2\Shared\Singleton;

/**
 * SingletonInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.28
 * @since   2.0.28 added
 */
interface SingletonInterface
{
    /**
     * Get the singleton instance.
     *
     * @return SingletonInterface
     * @access public
     * @static
     * @api
     */
    public static function getInstance()/*# : SingletonInterface */;
}
