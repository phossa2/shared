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

namespace Phossa2\Shared\Singleton;

use Phossa2\Shared\Base\ClassNameTrait;
use Phossa2\Shared\Base\ClassNameInterface;

/**
 * Singleton
 *
 * Singleton class
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     SingletonInterface
 * @see     ClassNameInterface
 * @version 2.0.28
 * @since   2.0.28 added ClassNameInterface
 */
class Singleton implements SingletonInterface, ClassNameInterface
{
    use SingletonTrait, ClassNameTrait;
}
