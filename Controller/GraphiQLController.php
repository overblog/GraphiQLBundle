<?php

namespace Overblog\GraphiQLBundle\Controller;

use Overblog\GraphiQLBundle\Config\GraphiQLViewConfig;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment as TwigEnvironment;

class GraphiQLController
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var TwigEnvironment
     */
    private $twig;

    /**
     * @var GraphiQLViewConfig
     */
    private $viewConfig;

    public function __construct(
        RouterInterface $router,
        TwigEnvironment $twig,
        GraphiQLViewConfig $viewConfig
    ) {
        $this->router = $router;
        $this->twig = $twig;
        $this->viewConfig = $viewConfig;
    }

    public function indexAction($schemaName = null)
    {
        if (null === $schemaName) {
            $endpoint = $this->router->generate('overblog_graphiql_endpoint');
        } else {
            $endpoint = $this->router->generate('overblog_graphiql_endpoint_multiple', ['schemaName' => $schemaName]);
        }

        return Response::create($this->twig->render(
            $this->viewConfig->getTemplate(),
            [
                'endpoint' => $endpoint,
                'versions' => [
                    'graphiql' => $this->viewConfig->getJavascriptLibraries()->getGraphiQLVersion(),
                    'react' => $this->viewConfig->getJavascriptLibraries()->getReactVersion(),
                    'fetch' => $this->viewConfig->getJavascriptLibraries()->getFetchVersion(),
                ],
            ]
        ));
    }
}
