<?php

namespace Overblog\GraphiQLBundle\Config\GraphQLEndpoint;

class GraphQLEndpointInvalidSchemaException extends \LogicException
{
    public static function forSchemaAndResolver($schemaName, $resolverClass)
    {
        return new static('Schema "'.$schemaName.'" isn\'t valid for resolver "'.$resolverClass.'"');
    }

    public static function forNoSchemaAndResolver($resolverClass)
    {
        return new static('NO schema provided for resolver "'.$resolverClass.'"');
    }
}
