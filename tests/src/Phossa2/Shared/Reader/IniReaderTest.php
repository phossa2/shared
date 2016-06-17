<?php

namespace Phossa2\Shared\Reader;

/**
 * IniReader test case.
 */
class IniReaderTest extends \PHPUnit_Framework_TestCase
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
     * Read non exist file
     *
     * @covers Phossa2\Shared\Reader\IniReader::readFile()
     * @expectedException Phossa2\Shared\Exception\NotFoundException
     * @expectedExceptionCode Phossa2\Shared\Message\Message::MSG_PATH_NOTFOUND
     */
    public function testReadFile1()
    {
        IniReader::readFile('nonexist.ini');
    }

    /**
     * Read ini file
     *
     * @covers Phossa2\Shared\Reader\IniReader::readFile()
     */
    public function testReadFile2()
    {
        $this->assertEquals(
            ['Test' => 'ddd'],
            IniReader::readFile(__DIR__ . '/good.ini')
        );
    }
}
