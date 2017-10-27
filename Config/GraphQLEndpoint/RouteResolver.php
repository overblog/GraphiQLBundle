<?php

namespace Overblog\GraphiQLBundle\Config\GraphQLEndpoint;

use Overblog\GraphiQLBundle\Config\GraphiQLControllerEndpoint;
use Symfony\Component\Routing\RouterInterface;

final class RouteResolver implements GraphiQLControllerEndpoint
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var array
     */
    private $routeCollection;

    public function __construct(RouterInterface $router, array $routeCollection)
    {
        $this->router = $router;
        $this->routeCollection = $routeCollection;
    }

    public function getBySchema($name)
    {
        $route = null;

        if (is_callable($this->routeCollection)) {
            $route = call_user_func($this->routeCollection, $name);
        }

        if (null === $route && array_key_exists($name, $this->routeCollection)) {
            $route = $this->routeCollection[$name];
        }

        if (!is_array($route)) {
            throw GraphQLEndpointInvalidSchemaException::forSchemaAndResolver($name, self::class);
        }

        return $this->router->generate(...$route);
    }

    public function getDefault()
    {
        return $this->getBySchema('default');
    }
}
