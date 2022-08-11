Custom GraphQL endpoint
=======

If your graphql endpoint is not the default one coming with the
[overblog/graphql-bundle](https://github.com/overblog/GraphQLBundle), then you might want to tell graphiql how to
resolve the route depending on a schema name.

By default it uses `Overblog\GraphiQLBundle\Config\GraphQLEndpoint\Helpers\OverblogGraphQLBundleEndpointResolver`.

### Configuration

Just set the `overblog_graphiql.endpoint_resolver` parameter like this:

```yaml
# in app/config/config.yml
overblog_graphiql:
    ....
    endpoint_resolver: \App\GraphiQL\EndpointResolver
```

### The Resolver

The resolver must be something like this:

```php
<?php

namespace App\GraphiQL;

class EndpointResolver
{
    public static function getByName($name)
    {
        if ('default' === $name) {
            return [
                'overblog_graphql_endpoint',
            ];
        }

        return [
            'graphql_default',
            ['schemaName' => $name],
        ];
    }
}
```

It must return an array of packed params which will be passed to `RouterInterface::generate` like this
`$router->generate(...$returnedValueOfTheGetByNameMethod)`.
 