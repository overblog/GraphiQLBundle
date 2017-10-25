<?php

namespace Overblog\GraphiQLBundle\Tests;

use Overblog\GraphiQLBundle\Tests\Fixtures\TestKernel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * TestCase.
 */
abstract class TestCase extends WebTestCase
{
    /** @var TestKernel[] */
    private static $kernels = [];

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

        $options['test_case'] = isset($options['test_case']) ? $options['test_case'] : null;

        $env = isset($options['environment']) ? $options['environment'] : 'overbloggraphbundletest'.strtolower($options['test_case']);
        $debug = isset($options['debug']) ? $options['debug'] : true;

        $kernelKey = $options['test_case'] ?: '__default__';
        $kernelKey .= '//'.$env.'//'.var_export($debug, true);

        if (!isset(self::$kernels[$kernelKey])) {
            self::$kernels[$kernelKey] = new static::$class($env, $debug, $options['test_case']);
        }

        return self::$kernels[$kernelKey];
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        static::$kernel = null;
    }
}
