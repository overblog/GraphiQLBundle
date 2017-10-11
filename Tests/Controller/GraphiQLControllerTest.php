<?php

/*
 * This file is part of the OverblogGraphQLBundle package.
 *
 * (c) Overblog <http://github.com/overblog/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Overblog\GraphQLBundle\Tests\Controller;

use Overblog\GraphiQLBundle\Tests\TestCase;

class GraphiQLControllerTest extends TestCase
{
    /**
     * @dataProvider graphiQLUriProvider
     */
    public function testIndexAction($uri)
    {
        $client = static::createClient();

        $client->request('GET', $uri);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function graphiQLUriProvider()
    {
        return [
            ['/graphiql'],
            ['/graphiql/default'],
        ];
    }
}
