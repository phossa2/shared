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

use Phossa2\Shared\Exception\LogicException;

/**
 * SingletonTrait
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     SingletonInterface
 * @version 2.0.28
 * @since   2.0.28 added
 */
trait SingletonTrait
{
    /**
     * Singletons' pool
     *
     * Use array here to make Singleton class INHERITABLE!
     *
     * @var    SingletonInstance[]
     * @access private
     * @static
     */
    private static $singletons = [];

    /**
     * {@inheritDoc}
     */
    public static function getInstance()/*# : SingletonInterface */
    {
        $class = get_called_class();
        if (!isset(self::$singletons[$class])) {
            self::$singletons[$class] = new static();
        }
        return self::$singletons[$class];
    }

    /**
     * no instantiation from outside
     *
     * @return void
     * @access protected
     * @final
     */
    protected function __construct()
    {
    }

    /**
     * prevent from being cloned.
     *
     * @return void
     * @access public
     * @final
     */
    final public function __clone()
    {
        throw new LogicException('SINGLETON CAN NOT BE CLONED');
    }

    /**
     * prevent from being unserialized.
     *
     * @return void
     * @access public
     * @final
     */
    final public function __wakeup()
    {
        throw new LogicException('SINGLETON CAN NOT BE WAKEUP');
    }
}
