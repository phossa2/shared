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

use Phossa2\Shared\Exception\LogicException;

/**
 * ExtensionAwareInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.23
 * @since   2.0.23 added
 */
interface ExtensionAwareInterface
{
    /**
     * Add one extension
     *
     * @param  ExtensionInterface $ext
     * @param  bool $forceOverride force override existing methods
     * @return $this
     * @throws LogicException if anything goes wrong
     * @access public
     * @api
     */
    public function addExtension(
        ExtensionInterface $ext,
        /*# bool */ $forceOverride = false
    );
}
