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

use Phossa2\Shared\Base\ObjectAbstract;

/**
 * Shareable
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     ObjectAbstract
 * @see     ShareableInterface
 * @version 2.0.10
 * @since   2.0.10 added
 */
class Shareable extends ObjectAbstract implements ShareableInterface
{
    use ShareableTrait;

    /**
     * instantiated with scopes
     *
     * @param  string|array $scopes
     * @access public
     */
    public function __construct($scopes = '')
    {
        // add scope if not empty
        if ('' !== $scopes) {
            $this->scopes = (array) $scopes;
        }
    }
}
