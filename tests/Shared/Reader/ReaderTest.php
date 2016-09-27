<?php

namespace Phossa2\Shared\Reader;

/**
 * Reader test case.
 */
class ReaderTest extends \PHPUnit_Framework_TestCase
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
     * Read xml file
     *
     * @covers Phossa2\Shared\Reader\Reader::readFile()
     *
     */
    public function testReadFile1()
    {
        $this->assertEquals(
            ['Test' => 'ddd'],
            Reader::readFile(__DIR__ . '/good.xml')
        );
    }

    /**
     * Unknown suffix found
     *
     * @covers Phossa2\Shared\Reader\Reader::readFile()
     * @expectedException Phossa2\Shared\Exception\RuntimeException
     */
    public function testReadFile2()
    {
        $this->assertEquals(
            ['Test' => 'ddd'],
            Reader::readFile(__DIR__ . '/good.ser')
        );
    }
}
