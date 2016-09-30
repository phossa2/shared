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
 * LoaderInterface
 *
 * Used for loading message mappings (such as language translations) for
 * different message classes from various source, e.g. from scattered
 * language files or one big file or from DB.
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.1.0
 * @since   2.0.0 added
 * @since   2.1.0 added `getLanguage()`
 */
interface LoaderInterface
{
    /**
     * Load message mappings for the message class.
     *
     * return empty array if not found.
     *
     * @param  string $className the fully qualified message class name
     * @return array
     * @access public
     */
    public function loadMessages(
        /*# string */ $className
    )/*# : array */;

    /**
     * Get current language setting
     *
     * @return string
     * @access public
     */
    public function getLanguage()/*# : string */;
}
