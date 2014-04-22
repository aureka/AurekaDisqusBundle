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
