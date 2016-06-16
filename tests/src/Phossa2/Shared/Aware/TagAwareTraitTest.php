<?php

namespace Phossa2\Shared\Aware;

/**
 * TagAwareTrait test case.
 */
class TagAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var    TagAware
     * @access protected
     */
    protected $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        require_once __DIR__ . '/TagAware.php';
        $this->object = new TagAware();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->object = null;
    }

    /**
     * @covers Phossa2\Shared\Aware\TagAwareTrait::addTag()
     * @covers Phossa2\Shared\Aware\TagAwareTrait::hasTag()
     * @covers Phossa2\Shared\Aware\TagAwareTrait::removeTag()
     */
    public function testAddTag()
    {
        // no tag yet
        $this->assertFalse($this->object->hasTag('test'));

        // add one tag
        $this->object->addTag('test');

        // test tag
        $this->assertTrue($this->object->hasTag('test'));

        // remove it
        $this->object->removeTag('test');

        // test again
        $this->assertFalse($this->object->hasTag('test'));
    }

    /**
     * @covers Phossa2\Shared\Aware\TagAwareTrait::getTags()
     */
    public function testGetTags()
    {
        // no tag yet
        $this->assertTrue([] == $this->object->getTags());

        // add one tag
        $this->object->addTag('test');

        // get again
        $this->assertTrue(['test'] == $this->object->getTags());

        // remove tag
        $this->object->removeTag('test');

        // try get again
        $this->assertTrue([] == $this->object->getTags());
    }

    /**
     * @covers Phossa2\Shared\Aware\TagAwareTrait::hasTags()
     * @covers Phossa2\Shared\Aware\TagAwareTrait::setTags()
     */
    public function testHasTags()
    {
        // set tags
        $this->object->setTags(['apple', 'orange', 'pear']);

        // find
        $this->assertTrue(['apple'] == $this->object->hasTags(['apple', 'bag']));

        // nothing found
        $this->assertTrue([] == $this->object->hasTags(['a', 'b']));

        // nothing to find
        $this->assertTrue([] == $this->object->hasTags([]));

        // clear tags
        $this->object->setTags([]);
        $this->assertFalse(['apple'] == $this->object->hasTags(['apple', 'bag']));
    }
}
