<?php

declare(strict_types=1);

namespace Overblog\GraphiQLBundle\Tests;

use ReflectionMethod;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use const PHP_VERSION_ID;

// see https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Tests/Functional/ForwardCompatTestCaseTrait.php

if (70000 <= PHP_VERSION_ID && (new ReflectionMethod(WebTestCase::class, 'tearDown'))->hasReturnType()) {
    eval('
        namespace Overblog\GraphiQLBundle\Tests;

        /**
         * @internal
         */
        trait ForwardCompatTestCaseTrait
        {
            protected function tearDown(): void
            {
                static::ensureKernelShutdown();
                static::$kernel = null;
            }
        }
    ');
} else {
    /**
     * @internal
     */
    trait ForwardCompatTestCaseTrait
    {
        protected function tearDown(): void
        {
            static::ensureKernelShutdown();
            static::$kernel = null;
        }
    }
}
