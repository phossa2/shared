<?php

namespace Phossa2\Shared\Reader;

/**
 * SerializedReader test case.
 */
class SerializedReaderTest extends \PHPUnit_Framework_TestCase
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
     * Read bad serialized file
     *
     * @covers Phossa2\Shared\Reader\SerializedReader::readFile()
     * @expectedException Phossa2\Shared\Exception\RuntimeException
     */
    public function testReadFile1()
    {
        $this->assertEquals(
            ['Test' => 'ddd'],
            SerializedReader::readFile(__DIR__ . '/bad_serialized.txt')
        );
    }

    /**
     * Read good serialized file
     *
     * @covers Phossa2\Shared\Reader\SerializedReader::readFile()
     */
    public function testReadFile2()
    {
        $this->assertEquals(
            ['Test' => 'ddd'],
            SerializedReader::readFile(__DIR__ . '/good_serialized.txt')
        );
    }
}
