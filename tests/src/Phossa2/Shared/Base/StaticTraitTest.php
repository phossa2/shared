<?php

namespace Phossa2\Shared\Base;

/**
 * StaticTrait test case.
 */
class StaticTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        require_once __DIR__ . '/StaticClass.php';
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Test instantiation
     *
     * @covers Phossa2\Shared\Base\StaticAbstract::__construct()
     * @expectedException Phossa2\Shared\Exception\RuntimeException
     * @expectedExceptionCode Phossa2\Shared\Message\Message::MSG_CLASS_STATIC
     */
    public function testConstruct()
    {
        $o = new StaticClass();
    }
}
