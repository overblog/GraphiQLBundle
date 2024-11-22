<?php

declare(strict_types=1);

namespace Overblog\GraphiQLBundle\Config\GraphQLEndpoint;

use RuntimeException;

class GraphQLEndpointInvalidSchemaException extends RuntimeException
{
    public static function forSchemaAndResolver($schemaName, $resolverClass)
    {
        return new static('Schema "'.$schemaName.'" isn\'t valid for resolver "'.$resolverClass.'"');
    }
}
