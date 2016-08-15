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
     *{@inheritDoc}
     */
    protected function bootExtension()
    {
    }

    public function myMethod($arg)
    {
        echo $arg;
    }
}
