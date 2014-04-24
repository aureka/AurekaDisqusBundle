AurekaDisqusBundle
=====================
[![Build Status](https://travis-ci.org/aureka/AurekaDisqusBundle.png)](https://travis-ci.org/aureka/AurekaDisqusBundle)

Provides Twig funtions to facilitate the integration of your Symfony site with Disqus. It renders the proper Javascript snippets for threads and comment count.

**Functions**
- `disqus(blogpost)`: Append the JavaScript for the disqus thread.
- `disqus_count()`: Appends the JavaScript for the comment count.



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

{# renders the thread and comment form #}
{{ disqus(blogpost) }}

{# adds the count for any disqus link #}
{{ disqus_count() }}
```

