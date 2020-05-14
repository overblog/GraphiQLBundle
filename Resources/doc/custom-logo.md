Custom logo
==============

By default the GraphiQL header will display GraphiQL logo.

You can change your logo using a custom variable on twig file.
```twig
{# templates/GraphiQL/index.html.twig #}
{% extends '@OverblogGraphiQL/GraphiQL/index.html.twig' %}

{% set logoPath = 'https://mylink.com/images/logo.png' %}
```

You can also work with local images
You can change your logo using a custom variable on twig file.
```twig
{# templates/GraphiQL/index.html.twig #}
{% extends '@OverblogGraphiQL/GraphiQL/index.html.twig' %}

{# move the file mylogo.png to public folder #}
{% set logoPath = 'mylogo.png' %}
```
