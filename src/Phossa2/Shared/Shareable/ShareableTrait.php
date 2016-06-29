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
 * Implementation of ShareableInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     ShareableInterface
 * @version 2.0.10
 * @since   2.0.10 added
 */
trait ShareableTrait
{
    /**
     * Shareables' pool
     *
     * @var    ShareableInstance[]
     * @access private
     * @staticvar
     */
    private static $shareables = [];

    /**
     * minimum constructor
     *
     * @access public
     * @final
     */
    final public function __construct()
    {
    }

    /*
     * {@inheritDoc}
     */
    public static function getShareable(
        /*# string */ $scope = '__GLOBAL__'
    )/*# : ShareableInterface */ {
        $class = get_called_class();
        if (!isset(self::$shareables[$scope][$class])) {
            self::$shareables[$scope][$class] = new static();
        }
        return self::$shareables[$class];
    }

    /*
     * {@inheritDoc}
     */
    public function isShareable(
        /*# string */ $scope = '__GLOBAL__'
    )/*# : bool */ {
        return $this === static::getShareable($scope);
    }
}
