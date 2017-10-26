<?php

namespace Overblog\GraphiQLBundle\Tests\Integration\OverblogGraphQLBundle;

use Overblog\GraphiQLBundle\Tests\Integration\OverblogGraphQLBundle\Fixtures\TestKernel;
use Overblog\GraphiQLBundle\Tests\TestCase as AbstractTestCase;

abstract class TestCase extends AbstractTestCase
{
    /**
     * {@inheritdoc}
     */
    protected static function getKernelClass()
    {
        return TestKernel::class;
    }

    protected static function createKernel(array $options = [])
    {
        $options['test_case'] = 'Integration_OverblogGraphQLBundle';

        return parent::createKernel($options);
    }
}
