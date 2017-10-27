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

    /**
     * @param string $name
     *
     * @return string
     */
    public function getBySchema($name = null)
    {
        if (is_callable($this->routeCollection)) {
            return $this->resolveByCallable($name);
        }

        $name = null === $name ? 'default' : $name;

        $route = array_key_exists($name, $this->routeCollection) ? $this->routeCollection[$name] : null;

        return $this->generateRoute($route, $name);
    }

    public function getDefault()
    {
        return $this->getBySchema();
    }

    private function resolveByCallable($name)
    {
        return $this->generateRoute(call_user_func($this->routeCollection, $name), $name);
    }

    private function generateRoute($route, $name)
    {
        if (!is_array($route)) {
            if (null === $name) {
                throw GraphQLEndpointInvalidSchemaException::forNoSchemaAndResolver(self::class);
            }
            throw GraphQLEndpointInvalidSchemaException::forSchemaAndResolver($name, self::class);
        }

        return $this->router->generate(...$route);
    }
}
