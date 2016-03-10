# Mollie API wrapper for Laravel 5.x

This is a package to integrate [Mollie](https://github.com/mollie/mollie-api-php) with Laravel 5.x.
You can use it to easily manage your configuration, and use the Facade to provide shortcuts to the Mollie Client.

## Install

Via Composer

``` bash
$ composer require petericebear/laravel-mollie
```

## Installation

Via Composer

    $ composer require petericebear/laravel-mollie

After updating composer, add the MollieServiceProvider to the providers array in config/app.php

    PeterIcebear\Mollie\Providers\MollieServiceProvider::class,

You need to publish the config for this package. A sample configuration is provided. The defaults will be merged with gateway specific configuration.

    $ php artisan vendor:publish --provider="PeterIcebear\Mollie\MollieServiceProvider"

To use the Facade (`\Mollie::getMethods()` instead of `App::make('mollie')->getMethods()`), add that to the facades array.

     'Mollie' => PeterIcebear\Mollie\Facades\Mollie::class,
