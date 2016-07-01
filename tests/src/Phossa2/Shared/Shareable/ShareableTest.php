<?php

namespace Phossa2\Shared\Shareable;

/**
 * Shareable test case.
 */
class ShareableTest extends \PHPUnit_Framework_TestCase
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
     * @covers Phossa2\Shared\Shareable\Shareable::getShareable()
     */
    public function testGetShareable()
    {
        $shared = Shareable::getShareable();

        // get instance
        $this->assertTrue($shared instanceof Shareable);

        // test shareable
        $this->assertTrue($shared->isShareable() !== false);

        // same instance
        $this->assertTrue($shared === Shareable::getShareable());
    }

    /**
     * Already has one shareable in scope ''
     *
     * @covers Phossa2\Shared\Shareable\Shareable::setShareable()
     * @expectedException Phossa2\Shared\Exception\RuntimeException
     * @expectedExceptionCode Phossa2\Shared\Message\Message::MSG_SHAREABLE_FAIL
     */
    public function testSetShareable1()
    {
        // create one
        Shareable::getShareable();

        // failed, already has one
        (new Shareable())->setShareable();
    }

    /**
     * Already is shareable, try assign to another scope
     *
     * @covers Phossa2\Shared\Shareable\Shareable::setShareable()
     * @expectedException Phossa2\Shared\Exception\RuntimeException
     * @expectedExceptionCode Phossa2\Shared\Message\Message::MSG_SHAREABLE_FAIL
     */
    public function testSetShareable2()
    {
        // get shareable in global scope
        $shared = Shareable::getShareable();

        // failed, try assign to another scope
        $shared->setShareable('newScope');
    }

    /**
     * @covers Phossa2\Shared\Shareable\Shareable::addScope()
     * @covers Phossa2\Shared\Shareable\Shareable::hasScope()
     */
    public function testAddScope()
    {
        // new instance
        $obj = new Shareable();

        // no scope yet
        $this->assertFalse($obj->hasScope('vendor'));

        // add scope
        $obj->addScope('vendor.app');

        // check scopes
        $this->assertTrue($obj->hasScope('vendor.app'));
        $this->assertTrue($obj->hasScope(''));
    }

    /**
     * @covers Phossa2\Shared\Shareable\Shareable::isShareable()
     */
    public function testIsShareable()
    {
        // new instance
        $obj = new Shareable();

        // not shareable yet
        $this->assertFalse($obj->isShareable() !== false);

        // add scope
        $shared = Shareable::getShareable();

        // is shareable now
        $this->assertTrue($shared->isShareable() !== false);
    }

    /**
     * @covers Phossa2\Shared\Shareable\Shareable::getShareables()
     */
    public function testGetShareables()
    {
        // new instance
        $obj = new Shareable();
        $obj->addScope('one')->addScope('two.three');

        $shareables = $obj->getShareables();

        // all 4 shareables
        $this->assertEquals(3, count($shareables));
    }
}
