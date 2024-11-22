<?php

declare(strict_types=1);

namespace Overblog\GraphiQLBundle\Tests\Config\GraphQLEndpoint\Helpers;

use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\Helpers\OverblogGraphQLBundleEndpointResolver;
use PHPUnit\Framework\TestCase;

final class OverblogGraphQLBundleEndpointResolverTest extends TestCase
{
    public function testGetDefaultRoute(): void
    {
        $defaultRoute = OverblogGraphQLBundleEndpointResolver::getByName('default');
        $this->assertSame(['overblog_graphql_endpoint'], $defaultRoute);
    }

    /**
     * @dataProvider getSchemas
     */
    public function testGetWithSchemaName($schemaName, $expectedResult): void
    {
        $route = OverblogGraphQLBundleEndpointResolver::getByName($schemaName);
        $this->assertSame($expectedResult, $route);
    }

    public function getSchemas()
    {
        return [
            ['bla', [
                'overblog_graphql_multiple_endpoint',
                ['schemaName' => 'bla'],
            ]],
            ['star-wars', [
                'overblog_graphql_multiple_endpoint',
                ['schemaName' => 'star-wars'],
            ]],
        ];
    }
}
