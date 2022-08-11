Custom GraphiQL parameters
==========================

By default, only the `fetcher` parameter is passed to GraphiQL's React component.
To add more:

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

{% block graphiql_params %}
{{ parent() }},
defaultQuery: `query SomeQuery($param: String) {
  items(param: $param) {
    someField
  }
}`
{% endblock graphiql_params %}
```
