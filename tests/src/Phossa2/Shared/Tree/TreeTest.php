<?php

namespace Phossa2\Shared\Tree;

/**
 * Tree test case.
 */
class TreeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var    Tree
     * @access protected
     */
    protected $tree;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $data = [
            'test.test1' => 'bingo',
            'test.test2.test3' => 'wow'
        ];

        $this->tree = new Tree($data);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->tree = null;
        parent::tearDown();
    }

    /**
     * @covers Phossa2\Shared\Tree\Tree::getTree()
     */
    public function testGetTree()
    {
        $this->assertEquals(
            ['test' => ['test1' => 'bingo', 'test2' => ['test3' => 'wow']]],
            $this->tree->getTree()
        );
    }

    /**
     * @covers Phossa2\Shared\Tree\Tree::getNode();
     */
    public function testGetNode()
    {
        // found 1
        $this->assertEquals(
            'bingo',
            $this->tree->getNode('test.test1')
        );

        // found 2
        $this->assertEquals(
            ['test3' => 'wow'],
            $this->tree->getNode('test.test2')
        );

        // not found
        $this->assertEquals(
            null,
            $this->tree->getNode('test.test4')
        );
    }

    /**
     * @covers Phossa2\Shared\Tree\Tree::deleteNode();
     */
    public function testDeleteNode()
    {
        // delete 1
        $this->tree->deleteNode('test.test2');
        $this->assertEquals(
            ['test1' => 'bingo'],
            $this->tree->getNode('test')
        );

        // delete 2
        $this->tree->deleteNode('test');
        $this->assertEquals(
            [],
            $this->tree->getTree()
        );
    }
}
