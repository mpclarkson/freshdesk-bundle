<?php

namespace Mpclarkson\FreshdeskBundle\Tests\DependencyInjection;

/**
 * @covers \Mpclarkson\FreshdeskBundle\DependencyInjection\Configuration
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsConfigurationInterface()
    {
        $rc = new \ReflectionClass('Mpclarkson\FreshdeskBundle\DependencyInjection\Configuration');

        $this->assertTrue($rc->implementsInterface('Symfony\Component\Config\Definition\ConfigurationInterface'));
    }
}
