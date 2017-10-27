<?php

namespace Overblog\GraphiQLBundle\Tests;

use Symfony\Component\HttpKernel\Kernel;

abstract class TestKernel extends Kernel
{
    private $testCase;

    public function __construct($environment, $debug, $testCase = null)
    {
        $this->testCase = null !== $testCase ? $testCase : false;
        parent::__construct($environment, $debug);
    }

    public function getCacheDir()
    {
        return sys_get_temp_dir().'/OverblogGraphQLBundle/'.Kernel::VERSION.'/'.$this->testCase.'/cache/'.$this->environment;
    }

    public function getLogDir()
    {
        return sys_get_temp_dir().'/OverblogGraphQLBundle/'.Kernel::VERSION.'/'.$this->testCase.'/logs';
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function isBooted()
    {
        return $this->booted;
    }
}
