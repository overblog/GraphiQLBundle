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
        return $this->router->generate($this->routeCollection[$name]);
    }

    public function getDefault()
    {
        return $this->getBySchema('default');
    }
}
