<?php

namespace Overblog\GraphiQLBundle\Tests\Config\GraphQLEndpoint;

use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\GraphQLEndpointInvalidSchemaException;
use Overblog\GraphiQLBundle\Config\GraphQLEndpoint\RouteResolver;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Routing\RouterInterface;

final class RouteResolverTest extends TestCase
{
    /** @var RouterInterface|ObjectProphecy */
    protected $router;

    public function setUp()
    {
        $this->router = $this->prophesize(RouterInterface::class);
    }

    /**
     * @param array $routeCollection
     *
     * @return RouteResolver
     */
    private function subject(array $routeCollection)
    {
        return new RouteResolver(
            $this->router->reveal(),
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
        $this->router->generate(Argument::exact('route_schema_default'))->willReturn('/');
        $this->router->generate(Argument::exact('route_schema_star_wars'))->willReturn('/star-wars');

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
