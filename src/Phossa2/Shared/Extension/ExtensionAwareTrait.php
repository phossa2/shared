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

use Phossa2\Shared\Message\Message;
use Phossa2\Shared\Exception\LogicException;
use Phossa2\Shared\Exception\BadMethodCallException;

/**
 * ExtensionAwareTrait
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     ExtensionAwareInterface
 * @version 2.0.23
 * @since   2.0.23 added
 */
trait ExtensionAwareTrait
{
    /**
     * Methods provided by extensions
     *
     * @var    array
     * @access protected
     */
    protected $extension_methods = [];

    /**
     * @param  string $method
     * @param  array $arguments
     * @return mixed
     * @throws BadMethodCallException if method not found
     * @access public
     */
    public function __call($method, array $arguments)
    {
        if ($this->hasExtensionMethod($method)) {
            return $this->runExtension($method, $arguments);
        }
        throw new BadMethodCallException(
            Message::get(Message::MSG_METHOD_NOTFOUND, $method),
            Message::MSG_METHOD_NOTFOUND
        );
    }

    /**
     * {@inheritDoc}
     */
    public function addExtension(
        ExtensionInterface $ext,
        /*# bool */ $forceOverride = false
    ) {
        foreach ($ext->methodsAvailable() as $method) {
            if (isset($this->extension_methods[$method]) &&
                !$forceOverride) {
                throw new LogicException(
                    Message::get(Message::MSG_EXTENSION_METHOD, $method),
                    Message::MSG_EXTENSION_METHOD
                );
            }
            $this->extension_methods[$method] = $ext;
        }
        $ext->boot($this);
        return $this;
    }

    /**
     * Is this method from extensions ?
     *
     * @param  string $method
     * @return bool
     * @access protected
     */
    protected function hasExtensionMethod(/*# string */ $method)/*# : bool */
    {
        return isset($this->extension_methods[$method]);
    }

    /**
     * Include this in server's __call()
     *
     * @param  string $method
     * @param  array $args
     * @return mixed
     * @access protected
     */
    protected function runExtension(/*# string */ $method, array $args)
    {
        /* @var $ext ExtensionInterface */
        $ext = $this->extension_methods[$method];

        // execute extesion method
        return call_user_func_array([$ext, $method], $args);
    }
}
