<?php

namespace Phossa2\Shared\Message;

use Phossa2\Shared\Message\Loader\LanguageLoader;
use Phossa2\Shared\Message\Formatter\HtmlFormatter;

/**
 * MessageAbstract test case.
 */
class MessageAbstractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        require_once __DIR__ . '/MessageOne.php';
        require_once __DIR__ . '/MessageTwo.php';
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
     * Common tests with get()
     *
     * @covers Phossa2\Shared\Message\MessageAbstract::get()
     */
    public function testGet()
    {
        // self message definition
        $this->assertEquals(
            'Class "ClassA" not found',
            MessageOne::get(MessageOne::MESG_CLASS_NOTFOUND, "ClassA")
        );

        // child class uses parent message template
        $this->assertEquals(
            'Class "ClassB" not found',
            MessageTwo::get(MessageTwo::MESG_CLASS_NOTFOUND, "ClassB")
        );

        // child class uses self message template
        $this->assertEquals(
            'Property "C" not found',
            MessageTwo::get(MessageTwo::MESG_PROP_NOTFOUND, "C")
        );

        // message code not exist, use default template
        $this->assertEquals(
            'message: code not found',
            MessageTwo::get(1005, "code not found")
        );

        // non int code
        $this->assertEquals(
            'code not found',
            MessageTwo::get("code not found")
        );

        // missing argument
        $this->assertEquals(
            'Property "" not found',
            MessageTwo::get(MessageTwo::MESG_PROP_NOTFOUND)
        );

        // extra arguments
        $this->assertEquals(
            'Property "A" not found B C',
            MessageTwo::get(MessageTwo::MESG_PROP_NOTFOUND, "A", "B", "C")
        );
    }

    /**
     * Language loader test
     *
     * @covers Phossa2\Shared\Message\MessageAbstract::setLoader()
     * @covers Phossa2\Shared\Message\MessageAbstract::unsetLoader()
     */
    public function testSetLoader()
    {
        // language loader for child
        MessageTwo::setLoader(new LanguageLoader());

        // child class is ok
        $this->assertEquals(
            '没有找到属性 "C"',
            MessageTwo::get(MessageTwo::MESG_PROP_NOTFOUND, "C")
        );

        // parent class still use english
        $this->assertEquals(
            'Class "ClassA" not found',
            MessageTwo::get(MessageTwo::MESG_CLASS_NOTFOUND, "ClassA")
        );

        // clear language loader
        MessageTwo::unsetLoader();

        // child class back to english
        $this->assertEquals(
            'Property "C" not found',
            MessageTwo::get(MessageTwo::MESG_PROP_NOTFOUND, "C")
        );

        // set parent loader affecting child also
        MessageAbstract::setLoader(new LanguageLoader());
        $this->assertEquals(
            '没有找到类 "ClassA"',
            MessageTwo::get(MessageTwo::MESG_CLASS_NOTFOUND, "ClassA")
        );

        MessageAbstract::unsetLoader();
    }

    /**
     * Manual set default mappings
     *
     * @covers Phossa2\Shared\Message\MessageAbstract::setMappings()
     */
    public function testSetMappings()
    {
        // override default template
        MessageTwo::setMappings([
            MessageTwo::MESG_PROP_NOTFOUND => 'New template "%s"'
        ]);

        $this->assertEquals(
            'New template "C"',
            MessageTwo::get(MessageTwo::MESG_PROP_NOTFOUND, "C")
        );
    }

    /**
     * Test formatter
     *
     * @covers Phossa2\Shared\Message\MessageAbstract::setFormatter()
     * @covers Phossa2\Shared\Message\MessageAbstract::unsetFormatter()
     */
    public function testSetFormatter()
    {
        // formatter affects all
        MessageTwo::setFormatter(new HtmlFormatter());

        $this->assertEquals(
            '<span class="message">Class "<b>ClassA</b>" not found</span>',
            MessageOne::get(MessageOne::MESG_CLASS_NOTFOUND, "ClassA")
        );

        // unset formatter for all
        MessageAbstract::unsetFormatter();

        $this->assertEquals(
            'Class "ClassA" not found',
            MessageOne::get(MessageOne::MESG_CLASS_NOTFOUND, "ClassA")
        );
    }
}
