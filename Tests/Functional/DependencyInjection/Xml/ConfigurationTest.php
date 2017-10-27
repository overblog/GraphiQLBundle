<?php

namespace Overblog\GraphiQLBundle\Tests\Functional\DependencyInjection\Xml;

use Overblog\GraphiQLBundle\Tests\Functional\DependencyInjection\Fixtures\Xml\TestKernel;
use Overblog\GraphiQLBundle\Tests\TestCase;

final class ConfigurationTest extends TestCase
{
    protected static function getKernelClass()
    {
        return TestKernel::class;
    }

    public function setUp()
    {
        static::bootKernel(['test_case' => str_replace('\\', '_', __NAMESPACE__)]);
    }

    public function testSuccessConfiguration()
    {
        /** @var TestKernel $kernel */
        $kernel = static::$kernel;

        $this->assertTrue($kernel->isBooted());
    }
}
