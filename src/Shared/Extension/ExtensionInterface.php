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

namespace Phossa2\Shared\Extension;

/**
 * ExtensionInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.23
 * @since   2.0.23 added
 */
interface ExtensionInterface
{
    /**
     * Array of method names this extension provides
     *
     * @return string[]
     * @access public
     * @api
     */
    public function methodsAvailable()/*# : array */;

    /**
     * Boot or prepare this extension for the server
     *
     * @param  ExtensionAwareInterface $server
     * @access public
     * @api
     */
    public function boot(ExtensionAwareInterface $server);
}
