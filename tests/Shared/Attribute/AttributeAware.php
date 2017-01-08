<?php

namespace Phossa2\Shared\Attribute;

class Student implements AttributeInterface
{
    use AttributeTrait;

    /**
     * @var    array
     * @access protected
     */
    protected static $default_attributes = [
        'gender' => 'male',
        'age' => 12,
        'name' => 'Phossa'
    ];

    public function __construct(array $attrs = [])
    {
        $this->setAttributes(
            $this->initStaticVar($attrs, 'default_attributes')
        );
    }
}

class FemaleStudent extends Student
{
    /**
     * {@inheritDoc}
     */
    protected static $default_attributes = [
        'gender' => 'female',
        'phone' => '1234567',
    ];
}

class CollegeFemaleStudent extends FemaleStudent
{
    /**
     * {@inheritDoc}
     */
    protected static $default_attributes = [
        'age' => 18,
    ];
}
