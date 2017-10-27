<?php

namespace Overblog\GraphiQLBundle\Controller;

use Overblog\GraphiQLBundle\Config\GraphiQLControllerEndpoint;
use Overblog\GraphiQLBundle\Config\GraphiQLViewConfig;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as TwigEnvironment;

final class GraphiQLController
{
    /**
     * @var TwigEnvironment
     */
    private $twig;

    /**
     * @var GraphiQLViewConfig
     */
    private $viewConfig;

    /**
     * @var GraphiQLControllerEndpoint
     */
    private $graphQLEndpoint;

    public function __construct(
        TwigEnvironment $twig,
        GraphiQLViewConfig $viewConfig,
        GraphiQLControllerEndpoint $graphQLEndpoint
    ) {
        $this->twig = $twig;
        $this->viewConfig = $viewConfig;
        $this->graphQLEndpoint = $graphQLEndpoint;
    }

    public function indexAction($schemaName = null)
    {
        $endpoint = null === $schemaName ? $this->graphQLEndpoint->getDefault() : $this->graphQLEndpoint->getBySchema($schemaName);

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
