AurekaDisqusBundle
=====================
[![Build Status](https://travis-ci.org/aureka/AurekaDisqusBundle.png)](https://travis-ci.org/aureka/AurekaDisqusBundle)

Provides a few Twig filters in order to facilitate the integration of your Symfony site with Disqus.

## Installation

Add the following line to your `composer.json`:

```json
{
    "require": {
        "aureka/disqus-bundle" : "dev-master"
    }
}
```

Execute `composer update`.

Add the following line to your `AppKernel.php`.

```php
public function registerBundles()
{
    $bundles = array(
        // your other bundles
        new Aureka\DisqusBundle\AurekaDisqusBundle(),
    );
}
```


## Configuration


Add the following lines to your `config.yml`:


```
aureka_disqus:
    short_name: 'your_shortname' # used to identify the site in disqus
```


## Usage

Make the class an implementation of the interface `Disqusable`:

```php
# src/Acme/DemoBundle/Entity/BlogPost.php

namespace Acme\DemoBundle\Entity;

use Aureka\DisqusBundle\Model\Disqusable;

class BlogPost implements Disqusable
{

    // ... your other methods

    public function getDisqusId()
    {
        return $this->disqusId; // generate it on the fly or make it persisted.
    }
}
```


Use the twig filter in your template.


```twig
{# src/Acme/DemoBundle/Resources/views/BlogPost/show.html.twig #}

{{ post|disqus }}
```

