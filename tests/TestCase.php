<?php

declare(strict_types=1);

namespace Overblog\GraphiQLBundle\Tests;

use Overblog\GraphiQLBundle\Tests\Fixtures\TestKernel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\KernelInterface;

abstract class TestCase extends WebTestCase
{
    /** @var TestKernel[] */
    private static $kernels = [];

    /**
     * {@inheritdoc}
     */
    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }

    /**
     * {@inheritdoc}
     */
    protected static function createKernel(array $options = []): KernelInterface
    {
        static::$class = static::getKernelClass();

        $options['test_case'] ??= 'default';

        $env = $options['environment'] ?? 'overbloggraphibundletest'.strtolower($options['test_case']);
        $debug = $options['debug'] ?? true;

        $kernelKey = '//'.$env.'//'.var_export($debug, true);

        if (!isset(self::$kernels[$kernelKey])) {
            self::$kernels[$kernelKey] = new static::$class($env, $debug, $options['test_case']);
        }

        return self::$kernels[$kernelKey];
    }
}
