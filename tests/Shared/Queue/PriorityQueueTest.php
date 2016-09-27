<?php

namespace Phossa2\Shared\Queue;

/**
 * PriorityQueue test case.
 */
class PriorityQueueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var    PriorityQueue
     * @access protected
     */
    protected $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->object = new PriorityQueue();
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
     * Call protected/private method of a class.
     *
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    protected function invokeMethod($methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass($this->object);
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($this->object, $parameters);
    }

    /**
     * @covers Phossa2\Shared\Queue\PriorityQueue::count
     */
    public function testCount()
    {
        // 0
        $this->assertTrue(0 === $this->object->count());

        // 1
        $this->object->insert([$this->object, 'count'], 10);
        $this->assertTrue(1 === count($this->object));
    }

    /**
     * @covers Phossa2\Shared\Queue\PriorityQueue::getIterator
     */
    public function testGetIterator1()
    {
        $it = $this->object->getIterator();
        $this->assertTrue($it instanceof \ArrayAccess);
    }

    /**
     * @covers Phossa2\Shared\Queue\PriorityQueue::getIterator
     */
    public function testGetIterator2()
    {
        $callable = [$this->object, 'count'];
        $this->object->insert($callable, 10);
        foreach ($this->object as $data) {
            $this->assertTrue($callable === $data['data']);
            $this->assertTrue(10 === $data['priority']);
        }
    }

    /**
     * @covers Phossa2\Shared\Queue\PriorityQueue::insert
     */
    public function testInsert1()
    {
        // insert callable
        $this->object->insert([$this->object, 'count'], 10);
        $this->assertTrue(1 === count($this->object));

        // insert another callable
        $this->object->insert([$this->object, 'flush'], 70);
        $this->assertTrue(2 === count($this->object));

        // insert callable one again (adjust priority only)
        $this->object->insert([$this->object, 'count'], 50);
        $this->assertTrue(2 === $this->object->count());
    }

    /**
     * test sorted order
     *
     * @covers Phossa2\Shared\Queue\PriorityQueue::insert
     */
    public function testInsert2()
    {
        $callable1 = [$this->object, 'count'];
        $callable2 = [$this->object, 'flush'];
        $callable3 = 'phpinfo';

        // insert callable, order 70
        $this->object->insert($callable1, 70);
        $this->object->insert($callable2, 20);
        $this->object->insert($callable3, 50);

        $result = [];
        foreach ($this->object as $data) {
            $result[] = $data['data'];
        }

        // check order
        $this->assertTrue($callable1 === $result[0]);
        $this->assertTrue($callable3 === $result[1]);
        $this->assertTrue($callable2 === $result[2]);
    }

    /**
     * @covers Phossa2\Shared\Queue\PriorityQueue::remove
     */
    public function testRemove()
    {
        $callable = [$this->object, 'count'];
        $this->object->insert($callable, 10);
        $this->assertTrue(1 === count($this->object));
        $this->object->remove($callable);
        $this->assertTrue(0 === count($this->object));
    }

    /**
     * @covers Phossa2\Shared\Queue\PriorityQueue::flush
     */
    public function testFlush()
    {
        $callable = [$this->object, 'count'];
        $this->object->insert($callable, 10);
        $this->assertTrue(1 === count($this->object));
        $this->object->flush();
        $this->assertTrue(0 === count($this->object));
    }

    /**
     * @covers Phossa2\Shared\Queue\PriorityQueue::combine
     */
    public function testCombine()
    {
        // callables
        $call1 = [$this->object, 'count'];
        $call2 = [$this->object, 'flush'];

        // queue 1
        $this->object->insert($call1, 10);

        // queue 2
        $que2 = new PriorityQueue();
        $que2->insert($call2, 20);

        $que3 = $this->object->combine($que2);

        // type right
        $this->assertTrue($que3 instanceof PriorityQueueInterface);

        // count right
        $this->assertTrue(2 === $que3->count());
    }
}
