<?php

namespace Phossa2\Shared\String;

/**
 * Conversion test case.
 */
class ConversionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @covers Phossa2\Shared\String\Conversion::convertCase();
     */
    public function testConvertCase()
    {
        $string = 'CamelTestString';

        // snake
        $this->assertEquals(
            'camel_test_string',
            Conversion::convertCase($string, 'snake')
        );

        // camel
        $this->assertEquals(
            'camelTestString',
            Conversion::convertCase($string, 'camel')
        );

        // camel
        $this->assertEquals(
            'CamelTestString',
            Conversion::convertCase($string, 'pascal')
        );
    }

    /**
     * @covers Phossa2\Shared\String\Conversion::hasSuffix();
     */
    public function testHasSuffix()
    {
        // has
        $this->assertTrue(
            Conversion::hasSuffix('stringSuffix', 'Suffix')
        );

        // case problem
        $this->assertFalse(
            Conversion::hasSuffix('stringSuffix', 'suffix')
        );

        // no suffix
        $this->assertFalse(
            Conversion::hasSuffix('string', 'Suffix')
        );
    }

    /**
     * @covers Phossa2\Shared\String\Conversion::removeSuffix();
     */
    public function testRemoveSuffix()
    {
        // removed
        $this->assertEquals(
            'string',
            Conversion::removeSuffix('stringSuffix', 'Suffix')
        );

        // untouched
        $this->assertEquals(
            'stringSuffix',
            Conversion::removeSuffix('stringSuffix', 'suffix') // case diff
        );

        $this->assertEquals(
            'stringXX',
            Conversion::removeSuffix('stringXX', 'Suffix') // no suffix
        );
    }
}
