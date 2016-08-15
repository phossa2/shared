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

use Phossa2\Shared\Base\ObjectAbstract;

/**
 * ExtensionAbstract
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     ObjectAbstract
 * @see     ExtensionInterface
 * @version 2.0.23
 * @since   2.0.23 added
 */
abstract class ExtensionAbstract extends ObjectAbstract implements ExtensionInterface
{
    /**
     * The server object
     *
     * @var    ExtensionAwareInterface
     * @access protected
     */
    protected $server;

    /**
     * The lazy boot flag
     *
     * @var    bool
     * @access protected
     */
    protected $booted = false;

    /**
     * {@inheritDoc}
     */
    public function methodsAvailable()/*# : array */
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function boot(ExtensionAwareInterface $server)
    {
        if (!$this->booted) {
            // bind server
            $this->server = $server;

            // call user defined boot
            $this->bootExtension();

            // call your own bootMethod here
            $this->booted = true;
        }
    }

    /**
     * The real boot method
     *
     * @access protected
     */
    abstract protected function bootExtension();
}
