<?php

namespace Phossa2\Shared\Reader;

/**
 * XmlReader test case.
 */
class XmlReaderTest extends \PHPUnit_Framework_TestCase
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
     * Read bad xml file
     *
     * @covers Phossa2\Shared\Reader\XmlReader::readFile()
     * @expectedException Phossa2\Shared\Exception\RuntimeException
     */
    public function testReadFile1()
    {
        $this->assertEquals(
            ['Test' => 'ddd'],
            XmlReader::readFile(__DIR__ . '/bad_xml.txt')
        );
    }

    /**
     * Read good xml file
     *
     * @covers Phossa2\Shared\Reader\XmlReader::readFile()
     */
    public function testReadFile2()
    {
        $this->assertEquals(
            ['Test' => 'ddd'],
            XmlReader::readFile(__DIR__ . '/good.xml')
        );
    }
}
