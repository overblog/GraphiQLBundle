<?php

namespace Overblog\GraphQLBundle\Tests\Controller;

use Overblog\GraphiQLBundle\Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class GraphiQLControllerTest extends TestCase
{
    /**
     * @dataProvider graphiQLUriProvider
     */
    public function testIndexAction($uri)
    {
        $client = static::createClient();

        $client->request('GET', $uri);
        $response = $client->getResponse();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->stringContains('Loading...', $response->getContent());
    }

    public function graphiQLUriProvider()
    {
        return [
            ['/graphiql'],
            ['/graphiql/default'],
        ];
    }
}
