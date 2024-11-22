<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Tests\Integration\OverblogGraphQLBundle\Controller;

use Overblog\GraphiQLBundle\Tests\Integration\OverblogGraphQLBundle\TestCase;
use Symfony\Component\HttpFoundation\Response;

final class GraphiQLControllerTest extends TestCase
{
    public function testDefaultSchema(): void
    {
        $client = static::createClient();

        $client->request('GET', '/graphiql');
        $response = $client->getResponse();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertStringContainsString('Loading...', $response->getContent());
        $this->assertStringContainsString('var endpoint = "\/"', $response->getContent());
    }
}
