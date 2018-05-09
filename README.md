OverblogGraphiQLBundle
======================

This Symfony bundle provides integration of [GraphiQL](https://github.com/graphql/graphiql) interface to your Symfony application

[![Build Status](https://travis-ci.org/overblog/GraphiQLBundle.svg?branch=master)](https://travis-ci.org/overblog/GraphiQLBundle)
[![Coverage Status](https://coveralls.io/repos/github/overblog/GraphiQLBundle/badge.svg?branch=master)](https://coveralls.io/github/overblog/GraphiQLBundle?branch=master)
[![Latest Stable Version](https://poser.pugx.org/overblog/graphiql-bundle/version)](https://packagist.org/packages/overblog/graphiql-bundle)
[![Latest Unstable Version](https://poser.pugx.org/overblog/graphiql-bundle/v/unstable)](https://packagist.org/packages/overblog/graphiql-bundle)
[![Total Downloads](https://poser.pugx.org/overblog/graphiql-bundle/downloads)](https://packagist.org/packages/overblog/graphiql-bundle)

Installation
------------

**a)** Download the bundle

In the project directory:

```bash
composer require --dev overblog/graphiql-bundle
```

Symfony Flex installation
------------

**Note** If you are using Symfony Standard go to the next section

**a)** Accept the contrib recipes installation from Symfony Flex

```
-  WARNING  overblog/graphiql-bundle (0.1): From github.com/symfony/recipes-contrib
    The recipe for this package comes from the "contrib" repository, which is open to community contributions.
    Do you want to execute this recipe?
    [y] Yes
    [n] No
    [a] Yes for all packages, only for the current installation session
    [p] Yes permanently, never ask again for this project
    (defaults to n):
```

**b)** In case you don't have twig

In the project directory:

```bash
composer require twig
```

If you are using twig ONLY for graphiql you might want to use `--dev` during composer require

Symfony Standard installation
------------

**a)** Enable the bundle in the 'dev' section

```php
// in app/AppKernel.php
class AppKernel extends Kernel
{
    // ...

    public function registerBundles()
    {
        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            // ...
            $bundles[] = new Overblog\GraphiQLBundle\OverblogGraphiQLBundle();
        }
    }
}
```

**b)** Enable GraphiQL endpoint

```yaml
# in app/config/routing_dev.yml
overblog_graphiql_endpoint:
    resource: "@OverblogGraphiQLBundle/Resources/config/routing.xml"
```

Done
------------

It's done now, navigate to `/graphiql` in your project url

More
------------

* [Custom HTTP headers](Resources/doc/custom-http-headers.md)
* [Custom GraphiQL parameters](Resources/doc/custom-parameters.md)
* [Define JavaScript libraries' versions](Resources/doc/libraries-versions.md)
* [Define a custom GraphQL endpoint](Resources/doc/graphql-endpoint.md)

Community
---------

* Get some support on [Symfony devs Slack](https://symfony.com/slack-invite)
  on the dedicated channel **overblog-graphql**.
* Follow us on [GitHub](https://github.com/overblog)

Contributing
------------

* [See contributing documentation](CONTRIBUTING.md)
* [Thanks to all contributors](https://github.com/overblog/GraphiQLBundle/graphs/contributors)
