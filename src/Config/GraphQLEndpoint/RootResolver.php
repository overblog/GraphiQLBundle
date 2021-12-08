<?php

namespace Overblog\GraphiQLBundle\Config\GraphQLEndpoint;

use Overblog\GraphiQLBundle\Config\GraphiQLControllerEndpoint;

final class RootResolver implements GraphiQLControllerEndpoint
{
    public function getBySchema($name)
    {
        if ('default' === $name) {
            return '/';
        }

        throw GraphQLEndpointInvalidSchemaException::forSchemaAndResolver($name, self::class);
    }

    public function getDefault()
    {
        return $this->getBySchema('default');
    }
}
