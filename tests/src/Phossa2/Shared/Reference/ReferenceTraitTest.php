<?php

namespace Phossa2\Shared\Reference;

/**
 * ReferenceTrait test case.
 */
class ReferenceTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @access protected
     */
    protected $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $data = [
            'test1' => 'Y${wow1}',
            'test2' => 'wow3',
            'wow1'  => '${${test2}}',
            'wow3'  => 'xxx',
            'xxx'   => '${yyy}',
            'yyy'   => 'b${xxx}',
        ];

        require_once __DIR__ . './Reference.php';

        $this->object = new Reference($data);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->object = null;
        parent::tearDown();
    }

    /**
     * @covers Phossa2\Shared\Reference\ReferenceTrait::hasReference()
     */
    public function testHasReference()
    {
        $matched = [];

        // test reference
        $str1 = 'xx${xy}';
        $this->assertTrue($this->object->hasReference($str1, $matched));
        $this->assertEquals('xy', $matched[2]);

        // recursive reference
        $str2 = 'xx${${z}}';
        $this->assertTrue($this->object->hasReference($str2, $matched));
        $this->assertEquals('z', $matched[2]);

        // first reference
        $str3 = 'xx${${y}${z}}';
        $this->assertTrue($this->object->hasReference($str3, $matched));
        $this->assertEquals('y', $matched[2]);

        // non string
        $str4 = ['${x}'];
        $this->assertFalse($this->object->hasReference($str4, $matched));
    }

    /**
     * @covers Phossa2\Shared\Reference\ReferenceTrait::setReference()
     */
    public function testSetReference()
    {
        $matched = [];
        $this->object->setReference('{{', '}}');

        // no ref
        $str1 = 'xx${xy}';
        $this->assertFalse($this->object->hasReference($str1, $matched));

        // has ref
        $str2 = 'xx{{z}}';
        $this->assertTrue($this->object->hasReference($str2, $matched));
        $this->assertEquals('z', $matched[2]);
    }

    /**
     * @covers Phossa2\Shared\Reference\ReferenceTrait::deReference()
     */
    public function testDeReference()
    {
        // test reference
        $str1 = 'xx${wow3}';
        $this->assertEquals('xxxxx', $this->object->deReference($str1));

        // recursive deref
        $str2 = 'xx${test1}';
        $this->assertEquals('xxYxxx', $this->object->deReference($str2));

        // loop found
        $str3 = '${xxx}ddd';
        $this->assertEquals('${yyy}', $this->object->deReference($str3));
    }
}
