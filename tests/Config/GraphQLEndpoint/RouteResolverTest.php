<?php

namespace Overblog\GraphiQLBundle\Tests\Config\GraphQLEndpoint;

use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\GraphQLEndpointInvalidSchemaException;
use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\RouteResolver;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Routing\RouterInterface;

final class RouteResolverTest extends TestCase
{
    /** @var RouterInterface|MockObject */
    protected $router;

    public function setUp(): void
    {
        $this->router = $this->createMock(RouterInterface::class);
    }

    /**
     * @param array $routeCollection
     *
     * @return RouteResolver
     */
    private function subject(array $routeCollection)
    {
        return new RouteResolver(
            $this->router,
            $routeCollection
        );
    }

    public function testInvalidRoute()
    {
        $routeResolver = $this->subject([]);

        $this->expectException(GraphQLEndpointInvalidSchemaException::class);
        $this->expectExceptionMessage('Schema "default" isn\'t valid for resolver "Overblog\GraphiQLBundle\Config\GraphQLEndpoint\RouteResolver"');

        $routeResolver->getDefault();
    }

    public function testArrayRoutes()
    {
        $this->router->expects($this->exactly(3))
            ->method('generate')
            ->withConsecutive(
                ['route_schema_default'],
                ['route_schema_default'],
                ['route_schema_star_wars']
            )
            ->willReturnOnConsecutiveCalls('/', '/', '/star-wars');

        $routeCollection = [
            'default' => ['route_schema_default'],
            'starWars' => ['route_schema_star_wars'],
        ];

        $routeResolver = $this->subject($routeCollection);

        $this->assertEquals('/', $routeResolver->getDefault());
        $this->assertEquals('/', $routeResolver->getBySchema('default'));
        $this->assertEquals('/star-wars', $routeResolver->getBySchema('starWars'));
    }
}
