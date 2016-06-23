<?php

namespace Phossa2\Shared\Reference;

/**
 * Sample reference class
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.0
 * @since   2.0.0 added
 */
class Reference implements ReferenceInterface
{
    use ReferenceTrait;

    /**
     * data
     *
     * @var    array
     * @access protected
     */
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * For unknown reference $name
     *
     * @param  string $name
     * @return mixed
     * @access protected
     */
    protected function resolveUnknown(/*# string */ $name)
    {
        return '';
    }

    /**
     * The real resolving method. return NULL for unknown reference
     *
     * @param  string $name
     * @return mixed
     * @access protected
     */
    protected function getReference(/*# string */ $name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        } else {
            return null;
        }
    }
}
