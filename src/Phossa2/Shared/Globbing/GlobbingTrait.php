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

namespace Phossa2\Shared\Globbing;

/**
 * GlobbingTrait
 *
 * Matches exact name like 'user.login' with 'user.*', 'u*.*' etc.
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.25
 * @since   2.0.20 added
 * @since   2.0.25 ending '*' now matches everything
 */
trait GlobbingTrait
{
    /**
     * Returns all names matches with $exactName
     *
     * e.g.
     * 'user.login' matches '*', 'u*.*', 'user.*', 'user.l*', 'user.login' etc.
     *
     * @param  string $exactName
     * @param  array $names
     * @return array
     * @access protected
     */
    protected function globbingNames(
        /*# string */ $exactName,
        array $names
    )/*# : array */ {
        $result = [];
        foreach ($names as $name) {
            if ($this->nameGlobbing($exactName, $name)) {
                $result[] = $name;
            }
        }
        return $result;
    }

    /**
     * Check to see if $name matches with $exactName
     *
     *  e.g.
     *  ```php
     *  // true
     *  $this->nameGlobbing('user.*', 'user.login');
     *
     *  // true
     *  $this->nameGlobbing('*', 'user.login');
     *
     *  // false
     *  $this->nameGLobbing('blog.*', 'user.login');
     *  ```
     *
     * @param  string $exactName
     * @param  string $name
     * @return bool
     * @access protected
     */
    protected function nameGlobbing(
        /*# string */ $exactName,
        /*# string */ $name
    )/*# : bool */ {
        if ($name === $exactName) {
            return true;
        } elseif (false !== strpos($name, '*')) {
            $pat = str_replace(array('.', '*'), array('[.]', '[^.]*+'), $name);
            // last '*' should be different
            $pat = substr($pat, -6) != '[^.]*+' ? $pat : (substr($pat, 0, -6) . '.*+');
            return (bool) preg_match('~^' . $pat . '$~', $exactName);
        } else {
            return false;
        }
    }
}
