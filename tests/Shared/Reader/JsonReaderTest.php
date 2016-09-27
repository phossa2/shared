<?php

namespace Phossa2\Shared\Reader;

/**
 * JsonReader test case.
 */
class JsonReaderTest extends \PHPUnit_Framework_TestCase
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
     * Read bad json file
     *
     * @covers Phossa2\Shared\Reader\JsonReader::readFile()
     * @expectedException Phossa2\Shared\Exception\RuntimeException
     * @expectedExceptionMessageRegExp /Syntax error/
     */
    public function testReadFile1()
    {
        $this->assertEquals(
            ['Test' => 'ddd'],
            JsonReader::readFile(__DIR__ . '/bad.json')
        );
    }

    /**
     * Read good json file
     *
     * @covers Phossa2\Shared\Reader\JsonReader::readFile()
     */
    public function testReadFile2()
    {
        $this->assertEquals(
            ['Test' => 'ddd'],
            JsonReader::readFile(__DIR__ . '/good.json')
        );
    }
}
