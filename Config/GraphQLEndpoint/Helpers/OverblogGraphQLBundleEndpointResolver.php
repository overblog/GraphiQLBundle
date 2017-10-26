<?php

namespace Overblog\GraphiQLBundle\Config\GraphQLEndpoint\Helpers;

final class OverblogGraphQLBundleEndpointResolver
{
    public static function getByName($name)
    {
        if ('default' === $name) {
            return [
                'overblog_graphiql_endpoint',
            ];
        }

        return [
            'overblog_graphiql_endpoint_multiple',
            ['schemaName' => $name],
        ];
    }
}
