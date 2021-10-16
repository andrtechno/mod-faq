# mod-faq

Module for PIXELION CMS

[![Latest Stable Version](https://poser.pugx.org/panix/mod-faq/v/stable)](https://packagist.org/packages/panix/mod-faq)
[![Total Downloads](https://poser.pugx.org/panix/mod-faq/downloads)](https://packagist.org/packages/panix/mod-faq)
[![Monthly Downloads](https://poser.pugx.org/panix/mod-faq/d/monthly)](https://packagist.org/packages/panix/mod-faq)
[![Daily Downloads](https://poser.pugx.org/panix/mod-faq/d/daily)](https://packagist.org/packages/panix/mod-faq)
[![Latest Unstable Version](https://poser.pugx.org/panix/mod-faq/v/unstable)](https://packagist.org/packages/panix/mod-faq)
[![License](https://poser.pugx.org/panix/mod-faq/license)](https://packagist.org/packages/panix/mod-faq)


## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

#### Either run

```
php composer require --prefer-dist panix/mod-faq "*"
```

or add

```
"panix/mod-faq": "*"
```

to the require section of your `composer.json` file.


#### Add to web config.
```
    'modules' => [
        'faq' => ['class' => 'panix\mod\faq\Module'],
    ],
```
#### Migrate
```
php yii migrate --migrationPath=vendor/panix/mod-faq/migrations
```
