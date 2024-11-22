<?php

declare(strict_types=1);

namespace Overblog\GraphiQLBundle\Tests\Integration\OverblogGraphQLBundle;

use Overblog\GraphiQLBundle\Tests\Integration\OverblogGraphQLBundle\Fixtures\TestKernel;
use Overblog\GraphiQLBundle\Tests\TestCase as AbstractTestCase;
use Symfony\Component\HttpKernel\KernelInterface;

abstract class TestCase extends AbstractTestCase
{
    /**
     * {@inheritdoc}
     */
    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }

    protected static function createKernel(array $options = []): KernelInterface
    {
        $options['test_case'] = 'Integration_OverblogGraphQLBundle';

        return parent::createKernel($options);
    }
}
