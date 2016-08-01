<?php

use Phossa2\Shared\Extension\ExtensionAbstract;
use Phossa2\Shared\Extension\ExtensionAwareInterface;

class MyExtension extends ExtensionAbstract
{
    /**
     * {@inheritDoc}
     */
    public function methodsAvailable()/*# : array */
    {
        return ['myMethod'];
    }

    /**
     *
     * @param  ExtensionAwareInterface $server
     * @access protected
     */
    protected function bootExtension(ExtensionAwareInterface $server)
    {
    }

    public function myMethod($arg)
    {
        echo $arg;
    }
}
