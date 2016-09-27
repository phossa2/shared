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

namespace Phossa2\Shared\Message\Loader;

/**
 * LoaderAwareTrait
 *
 * One implementation of `LoaderAwareInterface`
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     LoaderAwareInterface
 * @version 2.0.0
 * @since   2.0.0 added
 */
trait LoaderAwareTrait
{
    /**
     * Message loaders pool, [ classname => $loader ]
     *
     * @var    LoaderInterface[]
     * @access private
     */
    private static $loaders = [];

    /**
     * loader update indicator
     *
     * @var    bool
     * @access private
     */
    private static $updated = false;

    /**
     * Set/replace loader for current message class (static bind)
     *
     * @param  LoaderInterface $loader the mapping loader
     * @access public
     * @api
     */
    public static function setLoader(
        LoaderInterface $loader
    ) {
        // set loader for current class
        self::$loaders[get_called_class()] = $loader;

        // update indicator
        static::setStatus();
    }

    /**
     * Unset loader for calling message class
     *
     * if $search is true, search upwards in the inheritance tree
     *
     * @param  bool $search search upwards
     * @access public
     */
    public static function unsetLoader(/*# bool */ $search = false)
    {
        $class = static::hasLoader($search);
        if (false !== $class) {
            // unset loader for current class
            unset(self::$loaders[$class]);

            // update indicator
            static::setStatus();
        }
    }

    /**
     * Get loader for current message class (static bind)
     *
     * use `hasLoader()` before this method !
     *
     * @return LoaderInterface
     * @access protected
     */
    protected static function getLoader()/*# : LoaderInterface */
    {
        return self::$loaders[get_called_class()];
    }

    /**
     * Check loader for calling message class (static bind)
     *
     * if $search is true, search upwards in inhertiant tree for loader
     * if current class has no loader set
     *
     * @param  bool $search search upwards
     * @return false|string false or classname for which has loader
     * @access protected
     */
    protected static function hasLoader(
        /*# bool */ $search = false
    ) {
        $class = get_called_class();

        if (isset(self::$loaders[$class])) {
            return $class;
        } elseif (__CLASS__ === $class) {
            return false;
        } elseif ($search) {
            $parent = get_parent_class($class);
            return $parent::hasLoader(true);
        }

        return false;
    }

    /**
     * Set updated indicator
     *
     * @param  bool $status updated status
     * @access protected
     */
    protected static function setStatus(
        /*# bool */ $status = true
    ) {
        self::$updated = $status;
    }

    /**
     * Get updated indicator
     *
     * @return bool
     * @access protected
     */
    protected static function isStatusUpdated()/*: bool */
    {
        return self::$updated;
    }
}
