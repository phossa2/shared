<?php

namespace Phossa2\Shared\Attribute;

/**
 * AttributeTrait test case.
 */
class AttributeTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        require_once __DIR__ . '/AttributeAware.php';
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @covers Phossa2\Shared\Attribute\AttributeTrait::getAttribute()
     */
    public function testGetAttribute()
    {
        $obj = new Student(['name' => 'John']);

        // test default attrs
        $this->assertEquals('male', $obj->getAttribute('gender'));
        $this->assertEquals(12, $obj->getAttribute('age'));

        // test instance attr
        $this->assertEquals('John', $obj->getAttribute('name'));

        // test child class
        $obj = new FemaleStudent(['name' => 'Eva']);
        $this->assertEquals('female', $obj->getAttribute('gender'));
        $this->assertEquals(12, $obj->getAttribute('age')); // not changed
        $this->assertEquals('Eva', $obj->getAttribute('name'));
        $this->assertEquals('1234567', $obj->getAttribute('phone'));

        // test grand child
        $obj = new CollegeFemaleStudent();
        $this->assertEquals(18, $obj->getAttribute('age'));
        $this->assertEquals('Phossa', $obj->getAttribute('name'));
        $this->assertEquals('1234567', $obj->getAttribute('phone'));
    }

    /**
     * @covers Phossa2\Shared\Attribute\AttributeTrait::setAttribute()
     */
    public function testSetAttribute()
    {
        $obj = new FemaleStudent();

        // before set
        $this->assertEquals('Phossa', $obj->getAttribute('name'));

        // after set
        $obj->setAttribute('name', 'Eva');
        $this->assertEquals('Eva', $obj->getAttribute('name'));
    }

    /**
     * @covers Phossa2\Shared\Attribute\AttributeTrait::addAttribute()
     */
    public function testAddAttribute()
    {
        $obj = new CollegeFemaleStudent();

        // before add
        $this->assertEquals('1234567', $obj->getAttribute('phone'));

        // after add
        $obj->addAttribute('phone', '7654321');
        $this->assertEquals(['1234567','7654321'], $obj->getAttribute('phone'));
    }

    /**
     * @covers Phossa2\Shared\Attribute\AttributeTrait::setAttributes()
     * @covers Phossa2\Shared\Attribute\AttributeTrait::getAttributes()
     */
    public function testSetAttributes()
    {
        $obj = new CollegeFemaleStudent();

        // before set
        $this->assertEquals('1234567', $obj->getAttribute('phone'));

        // after set
        $attrs = ['test' => 'wow'];
        $obj->setAttributes($attrs);

        $this->assertEquals($attrs, $obj->getAttributes());
    }
}
