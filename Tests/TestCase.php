<?php

namespace Overblog\GraphiQLBundle\Tests;

use Overblog\GraphiQLBundle\Tests\Fixtures\TestKernel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class TestCase extends WebTestCase
{
    use ForwardCompatTestCaseTrait;

    /**
     * {@inheritdoc}
     */
    protected static function getKernelClass()
    {
        return TestKernel::class;
    }

    /**
     * {@inheritdoc}
     */
    protected static function createKernel(array $options = [])
    {
        if (null === static::$class) {
            static::$class = static::getKernelClass();
        }

        $options['test_case'] = isset($options['test_case']) ? $options['test_case'] : 'default';

        $env = isset($options['environment']) ? $options['environment'] : 'overbloggraphibundletest'.strtolower($options['test_case']);
        $debug = isset($options['debug']) ? $options['debug'] : true;

        return new static::$class($env, $debug, $options['test_case']);
    }
}
