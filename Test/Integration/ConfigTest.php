<?php

namespace Keyreal\Like2buy\Test\Integration;

use Magento\Framework\Component\ComponentRegistrar;
use Magento\TestFramework\ObjectManager;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testFail()
    {
        $this->fail('Fail');
    }

    public function testModuleIsRegistered()
    {
        $registrar = new ComponentRegistrar();
        $this->assertArrayHasKey('Keyreal_Like2buy', $registrar->getPaths(ComponentRegistrar::MODULE));
    }

    public function testModuleIsEnabled()
    {
        $om = ObjectManager::getInstance();
        // TODO: get ready
    }
}