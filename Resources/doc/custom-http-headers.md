Custom HTTP headers
==============

GraphiQL, provided by this bundle, sends the following default headers on each request:

```js
headers = {
  "Accept": "application/json",
  "Content-Type": "application/json"
};
```

Headers sent by GraphiQL can be modified. 
For example, let's assume an `access-token` header is required in development.
The header can be added the following way:

1. Override the default GraphiQL template:

```yaml
# config/packages/graphiql.yaml or app/config/config.yml for Symfony without Flex
overblog_graphiql:
    template: "GraphiQL/index.html.twig"
```
2. Create a new template:  

```twig
{# templates/GraphiQL/index.html.twig #}
{% extends '@OverblogGraphiQL/GraphiQL/index.html.twig' %}

{% block graphql_fetcher_headers %}
headers = {
  "Accept": "application/json",
  "Content-Type": "application/json",
  "access-token": "sometoken"
};
{% endblock graphql_fetcher_headers %}
```

Or append headers instead of replacing the default one:

```twig
{# templates/GraphiQL/index.html.twig #}
{% extends '@OverblogGraphiQL/GraphiQL/index.html.twig' %}

{% block graphql_fetcher_headers %}
{{ parent() }}
headers["access-token"] = "sometoken";
{% endblock graphql_fetcher_headers %}
```
