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

namespace Phossa2\Shared\Queue;

use Phossa2\Shared\Base\ObjectAbstract;

/**
 * PriorityQueue
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.20
 * @since   2.0.20 added
 */
class PriorityQueue extends ObjectAbstract implements PriorityQueueInterface
{
    use PriorityQueueTrait;
}
