<?php

namespace Overblog\GraphiQLBundle\Config\GraphQLEndpoint\Helpers;

final class OverblogGraphQLBundleEndpointResolver
{
    public static function getByName($name = null)
    {
        if ('default' === $name || null === $name) {
            return [
                'overblog_graphql_endpoint',
            ];
        }

        return [
            'overblog_graphql_multiple_endpoint',
            ['schemaName' => $name],
        ];
    }
}
