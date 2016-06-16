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

namespace Phossa2\Shared\Contract;

/**
 * ArrayableInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.0
 * @since   2.0.0 added
 */
interface ArrayableInterface
{
    /**
     * convert object $this to array
     *
     * @return array
     * @access public
     * @api
     */
    public function toArray()/*# : array */;

    /**
     * set object property from array
     *
     * @param  array $data
     * @return $this
     * @access public
     * @api
     */
    public function fromArray(array $data);
}
