<?php

namespace Phossa2\Shared\Globbing;

/**
 * GlobbingTrait test case.
 */
class GlobbingTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var    \Globbing
     * @access protected
     */
    protected $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        require_once __DIR__ . '/Globbing.php';

        $this->object = new \Globbing();
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
     * name globbing
     *
     * @covers Phossa2\Shared\GlobbingTrait::nameGlobbing
     */
    public function testNameGlobbing()
    {
        $this->assertTrue($this->invokeMethod(
            'nameGlobbing',
            ['login', '*']
        ));

        $this->assertTrue($this->invokeMethod(
            'nameGlobbing',
            ['login', 'login']
        ));

        $this->assertTrue($this->invokeMethod(
            'nameGlobbing',
            ['login', 'l*']
        ));

        $this->assertFalse($this->invokeMethod(
            'nameGlobbing',
            ['login', '*.*']
        ));

        $this->assertFalse($this->invokeMethod(
            'nameGlobbing',
            ['login', 'l*.*']
        ));

        $this->assertTrue($this->invokeMethod(
            'nameGlobbing',
            ['login.test', '*']
        ));

        $this->assertTrue($this->invokeMethod(
            'nameGlobbing',
            ['login.test', '*.*']
        ));

        $this->assertFalse($this->invokeMethod(
            'nameGlobbing',
            ['login.test', '*.*.*']
        ));

        $this->assertTrue($this->invokeMethod(
            'nameGlobbing',
            ['login.test', '*.test']
        ));
    }

    /**
     * globbing names
     *
     * @covers Phossa2\Shared\GlobbingTrait::globbingNames
     */
    public function testGlobbingNames()
    {
        $data = ['*', '*.*', '*.*.*', 'l*', 'l*.*', 'login.*'];
        $this->assertEquals(
            ['*', '*.*', 'l*.*', 'login.*'],
            $this->invokeMethod(
                'globbingNames',
                ['login.test', $data]
            )
        );
    }
}
