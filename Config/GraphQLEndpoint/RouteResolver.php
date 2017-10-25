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
    private $endpointMap;

    public function __construct(RouterInterface $router, array $endpointMap)
    {
        $this->router = $router;
        $this->endpointMap = $endpointMap;
    }

    public function getBySchema($name)
    {
        return $this->router->generate($this->endpointMap[$name]);
    }

    public function agetBySchema($name)
    {
        if (null === $name) {
            $endpoint = $this->router->generate('overblog_graphiql_endpoint');
        } else {
            $endpoint = $this->router->generate('overblog_graphiql_endpoint_multiple', ['schemaName' => $name]);
        }

        return $endpoint;
    }

    public function getDefault()
    {
        return '/';
    }
}
