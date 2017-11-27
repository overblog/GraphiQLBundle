OverblogGraphQLBundle
======================

This Symfony bundle provides integration of [GraphQL](https://facebook.github.io/graphql/) using [webonyx/graphql-php](https://github.com/webonyx/graphql-php)
and [GraphQL Relay](https://facebook.github.io/relay/docs/graphql-relay-specification.html).
It also supports batching using libs like [ReactRelayNetworkLayer](https://github.com/nodkz/react-relay-network-layer) or [Apollo GraphQL](http://dev.apollodata.com/core/network.html#query-batching).

[![Build Status](https://travis-ci.org/overblog/GraphiQLBundle.svg?branch=master)](https://travis-ci.org/overblog/GraphiQLBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/overblog/GraphiQLBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/overblog/GraphiQLBundle/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/overblog/GraphiQLBundle/badge.svg?branch=master)](https://coveralls.io/github/overblog/GraphiQLBundle?branch=master)
[![Latest Stable Version](https://poser.pugx.org/overblog/graphiql-bundle/version)](https://packagist.org/packages/overblog/graphiql-bundle)
[![Latest Unstable Version](https://poser.pugx.org/overblog/graphiql-bundle/v/unstable)](https://packagist.org/packages/overblog/graphiql-bundle)
[![Total Downloads](https://poser.pugx.org/overblog/graphiql-bundle/downloads)](https://packagist.org/packages/overblog/graphiql-bundle)

Documentation
-------------

Symfony Flex installation
------------

**Note:** OverblogGraphQLBundle only supports Symfony Flex from version 0.9.0 onwards

**a)** Download the bundle

In the project directory:

```bash
composer require --dev overblog/graphiql-bundle
```

Twig is also required, if you don't have it yet:
```bash
composer require twig
```

**b)** Accept the contrib recipes installation from Symfony Flex

```
-  WARNING  overblog/graphql-bundle (0.9): From github.com/symfony/recipes-contrib
    The recipe for this package comes from the "contrib" repository, which is open to community contributions.
    Do you want to execute this recipe?
    [y] Yes
    [n] No
    [a] Yes for all packages, only for the current installation session
    [p] Yes permanently, never ask again for this project
    (defaults to n):
```

It's done now, navigate to `/graphiql` in your project url

Community
---------

* Get some support on [Symfony devs Slack](https://symfony.com/slack-invite)
  on the dedicated channel **overblog-graphql**.
* Follow us on [GitHub](https://github.com/overblog)

Contributing
------------

* [See contributing documentation](CONTRIBUTING.md)
* [Thanks to all contributors](https://github.com/overblog/GraphiQLBundle/graphs/contributors)
