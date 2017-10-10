<?php

/*
 * This file is part of the OverblogGraphiQLBundle package.
 *
 * (c) Overblog <http://github.com/overblog/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Overblog\GraphiQLBundle\Controller;

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
     * @var String
     */
    private $twigGraphiqlTemplate;

    public function __construct(
        RouterInterface $router,
        TwigEnvironment $twig,
        $twigGraphiqlTemplate
    ) {
        $this->router = $router;
        $this->twig = $twig;
        $this->twigGraphiqlTemplate = $twigGraphiqlTemplate;
    }

    public function indexAction($schemaName = null)
    {
        if (null === $schemaName) {
            $endpoint = $this->router->generate('overblog_graphql_endpoint');
        } else {
            $endpoint = $this->router->generate('overblog_graphql_multiple_endpoint', ['schemaName' => $schemaName]);
        }

        return Response::create($this->twig->render(
            $this->twigGraphiqlTemplate,
            [
                'endpoint' => $endpoint,
                'versions' => [
                    'graphiql' => $this->getParameter('overblog_graphql.versions.graphiql'),
                    'react' => $this->getParameter('overblog_graphql.versions.react'),
                    'fetch' => $this->getParameter('overblog_graphql.versions.fetch'),
                ],
            ]
        ));
    }
}
