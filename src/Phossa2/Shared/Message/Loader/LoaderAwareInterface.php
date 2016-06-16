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
 * LoaderAwareInterface
 *
 * - Loader is used to load different mappings instead of using the default.
 *   Usually, it is used to load language files.
 *
 * - Different message class may use different loader.
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.0
 * @since   2.0.0 added
 */
interface LoaderAwareInterface
{
    /**
     * Set/replace loader for current message class (static bind)
     *
     * @param  LoaderInterface $loader the mapping loader
     * @access public
     * @api
     */
    public static function setLoader(
        LoaderInterface $loader
    );

    /**
     * Unset loader for calling message class
     *
     * if $search is true, search upwards in the inheritance tree
     *
     * @param  bool $search search upwards
     * @access public
     */
    public static function unsetLoader(/*# bool */ $search = false);
}
