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

namespace Phossa2\Shared\Shareable;

use Phossa2\Shared\Exception\RuntimeException;

/**
 * ShareableInterface
 *
 * - Instances can be instantiated, but a shared instance in the scope (default
 *   global scope is '') can only be get thru `::getShareable($scope)`.
 *
 * - Hierarchy scope of 'vendor.app' belongs to 'vendor' and '' (global)
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.10
 * @since   2.0.10 added
 */
interface ShareableInterface
{
    /**
     * Get the shared instance for $scope
     *
     * @param  string $scope default to '' (global)
     * @return ShareableInterface
     * @access public
     * @static
     * @api
     */
    public static function getShareable(
        /*# string */ $scope = ''
    )/*# : ShareableInterface */;

    /**
     * Get all avaiable scopes for this class
     *
     * @return string[]
     * @access public
     * @static
     * @api
     */
    public static function getScopes()/*# : array */;

    /**
     * Set $this as the shared instance for $scope
     *
     * @param  string $scope default to '' (global)
     * @return $this
     * @throws RuntimeException if shareable exists already
     * @access public
     * @api
     */
    public function setShareable(/*# string */ $scope = '');

    /**
     * Is $this the shared instance for $scope, false or returns the scope
     *
     * @return string|false
     * @access public
     * @api
     */
    public function isShareable();

    /**
     * Add $scope to $this instance
     *
     * - adding scope to a shared instance will be ignored
     * - all non-shareables belongs to the global scope ''
     *
     * @param  string $scope
     * @return $this
     * @access public
     * @api
     */
    public function addScope(/*# string */ $scope);

    /**
     * Is $this belongs to $scope ?
     *
     * @param  string $scope
     * @return bool
     * @access public
     * @api
     */
    public function hasScope(/*# string */ $scope = '')/*# : bool */;

    /**
     * Get all shared instances for $this instance's scopes
     *
     * @return ShareableInterface[]
     * @access public
     * @api
     */
    public function getShareables()/*# : array */;
}
