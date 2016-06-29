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

/**
 * ShareableInterface
 *
 * Instances can be instantiated with `new`, but a shareable copy in one scope
 * can only be get thru `getShareable($scope)`
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.10
 * @since   2.0.10 added
 */
interface ShareableInterface
{
    /**
     * Get the shared instance for this $scope
     *
     * @param  string $scope default to '__GLOBAL__'
     * @return ShareableInterface
     * @access public
     * @static
     * @api
     */
    public static function getShareable(
        /*# string */ $scope = '__GLOBAL__'
    )/*# : ShareableInterface */;

    /**
     * Set the shared instance for this $scope
     *
     * @param  ShareableInterface $instance
     * @param  string $scope default to '__GLOBAL__'
     * @access public
     * @static
     * @api
     */
    public static function setShareable(
        ShareableInterface $instance,
        /*# string */ $scope = '__GLOBAL__'
    );

    /**
     * Is $this the shared instance for this $scope ?
     *
     * @param  string $scope default to '__GLOBAL__'
     * @return bool
     * @access public
     * @api
     */
    public function isShareable(
        /*# string */ $scope = '__GLOBAL__'
    )/*# : bool */;
}
