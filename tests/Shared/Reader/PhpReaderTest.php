<?php

namespace Phossa2\Shared\Reader;

/**
 * PhpReader test case.
 */
class PhpReaderTest extends \PHPUnit_Framework_TestCase
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
     * Read good php file
     *
     * @covers Phossa2\Shared\Reader\PhpReader::readFile()
     */
    public function testReadFile2()
    {
        $this->assertEquals(
            ['Test' => 'ddd'],
            PhpReader::readFile(__DIR__ . '/good.php')
        );
    }
}
