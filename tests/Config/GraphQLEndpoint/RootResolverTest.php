<?php

declare(strict_types=1);

namespace Overblog\GraphiQLBundle\Tests\Config\GraphQLEndpoint;

use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\GraphQLEndpointInvalidSchemaException;
use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\RootResolver;
use PHPUnit\Framework\TestCase;

final class RootResolverTest extends TestCase
{
    /**
     * @return RootResolver
     */
    private function subject()
    {
        return new RootResolver();
    }

    public function testInvalidSchema(): void
    {
        $rootResolver = $this->subject();

        $this->expectException(GraphQLEndpointInvalidSchemaException::class);
        $this->expectExceptionMessage('Schema "any" isn\'t valid for resolver "Overblog\GraphiQLBundle\Config\GraphQLEndpoint\RootResolver"');

        $rootResolver->getBySchema('any');
    }

    public function testDefaultSchema(): void
    {
        $rootResolver = $this->subject();

        $this->assertEquals('/', $rootResolver->getDefault());
        $this->assertEquals('/', $rootResolver->getBySchema('default'));
    }
}
