<?php

namespace Overblog\GraphiQLBundle\Config\GraphQLEndpoint;

class GraphQLEndpointInvalidSchemaException extends \RuntimeException
{
    public static function forSchemaAndResolver($schemaName, $resolverClass)
    {
        return new static('Schema "'.$schemaName.'" isn\'t valid for resolver "'.$resolverClass.'"');
    }
}
