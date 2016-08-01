<?php

namespace Phossa2\Shared\Extension;

/**
 * ExtensionAbstract test case.
 */
class ExtensionAbstractTest extends \PHPUnit_Framework_TestCase
{
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        require_once __DIR__ . '/MyExtension.php';
        require_once __DIR__ . '/MyServer.php';

        $this->object = new \MyExtension();

        parent::setUp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->object = null;
        parent::tearDown();
    }

    /**
     * getPrivateProperty
     *
     * @param  string $propertyName
     * @return the property
     */
    public function getPrivateProperty($propertyName) {
        $reflector = new \ReflectionClass($this->object);
        $property  = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property->getValue($this->object);
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
     * @covers Phossa2\Shared\Extension\ExtensionAbstract::methodsAvailable()
     */
    public function testMethodsAvailable()
    {
        $this->assertEquals(['myMethod'], $this->object->methodsAvailable());
    }

    /**
     * @covers Phossa2\Shared\Extension\ExtensionAbstract::boot()
     */
    public function testBoot()
    {
        $this->assertFalse($this->getPrivateProperty('booted'));
        $this->assertNull($this->getPrivateProperty('server'));

        $server = new \MyServer();
        $this->object->boot($server);

        $this->assertTrue($this->getPrivateProperty('booted'));
        $this->assertEquals($server, $this->getPrivateProperty('server'));
    }
}
