<?php

namespace Phossa2\Shared\Extension;

/**
 * ExtensionAwareTrait test case.
 */
class ExtensionAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    private $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        require_once __DIR__ . '/MyExtension.php';
        require_once __DIR__ . '/MyServer.php';

        $this->object = new \MyServer();

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
     * Normal/force add extension
     *
     * @covers Phossa2\Shared\Extension\ExtensionAwareTrait::addExtension()
     */
    public function testAddExtension()
    {
        $this->assertEquals([], $this->getPrivateProperty('extension_methods'));

        $ext = new \MyExtension();
        $this->object->addExtension($ext);
        $this->object->addExtension($ext, true);

        $this->assertArrayHasKey('myMethod', $this->getPrivateProperty('extension_methods'));
    }

    /**
     * Duplicated methods in extension
     *
     * @covers Phossa2\Shared\Extension\ExtensionAwareTrait::addExtension()
     * @expectedException Phossa2\Shared\Exception\LogicException
     * @expectedExceptionCode Phossa2\Shared\Message\Message::MSG_EXTENSION_METHOD
     */
    public function testAddExtension2()
    {
        $ext = new \MyExtension();
        $this->object->addExtension($ext);
        $this->object->addExtension($ext);
    }

    /**
     * @covers Phossa2\Shared\Extension\ExtensionAwareTrait::runExtension()
     */
    public function testRunExtension()
    {
        $ext = new \MyExtension();
        $this->object->addExtension($ext);

        $this->expectOutputString('test');
        $this->object->myMethod('test');
    }

    /**
     * Unknown method
     *
     * @covers Phossa2\Shared\Extension\ExtensionAwareTrait::runExtension()
     * @expectedException Phossa2\Shared\Exception\BadMethodCallException
     * @expectedExceptionCode Phossa2\Shared\Message\Message::MSG_METHOD_NOTFOUND
     */
    public function testRunExtension2()
    {
        $ext = new \MyExtension();
        $this->object->addExtension($ext);

        $this->object->notExistingMethod('test');
    }
}
