<?php

namespace Phossa2\Shared\Base;

/**
 * ClassNameTrait test case.
 */
class ClassNameTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var    ObjectAbstract
     * @access protected
     */
    protected $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        require_once __DIR__ . '/Object.php';

        $this->object = new Object();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->object = null;
    }

    /**
     * @covers Phossa2\Shared\Base\ObjectAbstract::getClassName()
     * @covers Phossa2\Shared\Base\ObjectAbstract::getShortName()
     * @covers Phossa2\Shared\Base\ObjectAbstract::getNameSpace()
     */
    public function testGetClassName()
    {
        // classname
        $this->assertEquals(
            'Phossa2\\Shared\\Base\\Object',
            Object::getClassName()
        );

        // shortname
        $this->assertEquals(
            'Object',
            Object::getShortName()
        );

        // namespace
        $this->assertEquals(
            'Phossa2\\Shared\\Base',
            Object::getNameSpace()
        );
    }

    /**
     * @covers Phossa2\Shared\Base\ObjectAbstract::getNameSpace()
     */
    public function testGetNameSpace()
    {
        $this->assertEquals('', Object::getNameSpace('Base'));
        $this->assertEquals('Test', Object::getNameSpace('Test\\Base'));
        $this->assertEquals('Bingo\\Test', Object::getNameSpace('Bingo\\Test\\Base'));
    }

    /**
     * @covers Phossa2\Shared\Base\ObjectAbstract::getShortName()
     */
    public function testGetShortName()
    {
        $this->assertEquals('Base', Object::getShortName('Base'));
        $this->assertEquals('Base', Object::getShortName('Test\\Base'));
        $this->assertEquals('Base', Object::getShortName('Bingo\\Test\\Base'));
    }
}
