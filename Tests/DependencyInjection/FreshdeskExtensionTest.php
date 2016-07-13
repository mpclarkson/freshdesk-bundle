<?php

namespace Mpclarkson\FreshdeskBundle\Tests\DependencyInjection;

use Mpclarkson\FreshdeskBundle\DependencyInjection\FreshdeskExtension;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;

/**
 * @covers \Mpclarkson\FreshdeskBundle\DependencyInjection\Configuration
 * @covers \Mpclarkson\FreshdeskBundle\DependencyInjection\HileniumStyleExtension
 */
class FreshdeskExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    protected $containerBuilder;

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testUserLoadThrowsExceptionUnlessDriverIsValid()
    {
        $loader = new FreshdeskExtension();
        $config = array('key' => 'foo');
        $loader->load(array($config), new ContainerBuilder());
    }

    public function testConfig()
    {
        $this->createFullConfiguration();

        $this->assertParameter('foo_key', 'freshdesk_api_key');
        $this->assertParameter('bar_domain', 'freshdesk_domain');

        $this->assertContains('freshdesk', $this->containerBuilder->getServiceIds());}

    /**
     * @return ContainerBuilder
     */
    protected function createFullConfiguration()
    {
        $this->containerBuilder = new ContainerBuilder();
        $loader = new FreshdeskExtension();
        $loader->load(array($this->getFullConfig()), $this->containerBuilder);
        $this->assertTrue($this->containerBuilder instanceof ContainerBuilder);
    }

    protected function getFullConfig()
    {
        $yaml = <<<EOF
api_key: 'foo_key'
domain: 'bar_domain'
EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }

    private function assertParameter($value, $key)
    {
        $this->assertEquals($value, $this->containerBuilder->getParameter($key), sprintf('%s parameter is correct', $key));
    }

    protected function tearDown()
    {
        unset($this->containerBuilder);
    }
}
