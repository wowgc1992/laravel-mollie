# Mollie API wrapper for Laravel 5.x

This is a package to integrate [Mollie](https://github.com/mollie/mollie-api-php) with Laravel 5.x.
You can use it to easily manage your configuration, and use the Facade to provide shortcuts to the Mollie Client.

<p align="center">
<a href="https://travis-ci.org/petericebear/laravel-mollie"><img src="https://img.shields.io/travis/petericebear/laravel-mollie/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://styleci.io/repos/53579169"><img src="https://styleci.io/repos/53579169/shield" alt="StyleCI"></a>
<a href="https://scrutinizer-ci.com/g/petericebear/laravel-mollie/"><img src="https://scrutinizer-ci.com/g/petericebear/laravel-mollie/badges/quality-score.png?b=master" title="Scrutinizer Code Quality"></a>
<a href="https://scrutinizer-ci.com/g/petericebear/laravel-mollie/"><img src="https://scrutinizer-ci.com/g/petericebear/laravel-mollie/badges/coverage.png?b=master" alt="Code Coverage"></a>
<a href="LICENSE.md"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://packagist.org/packages/petericebear/laravel-mollie"><img src="https://img.shields.io/packagist/dt/petericebear/laravel-mollie.svg?style=flat-square" alt="Total Downloads"></img></a>
<a href="https://github.com/petericebear/laravel-mollie/releases"><img src="https://img.shields.io/github/release/petericebear/laravel-mollie.svg?style=flat-square" alt="Latest Version"></img></a>
</p>

## Requirements
To use the Mollie API client, the following things are required:

+ Get yourself a free [Mollie account](https://www.mollie.com/aanmelden). No sign up costs.
+ Create a new [Website profile](https://www.mollie.com/beheer/account/profielen/) to generate API keys (live and test mode) and setup your webhook.
+ Now you're ready to use the Mollie API client in test mode.
+ In order to accept payments in live mode, payment methods must be activated in your account. Follow [a few of steps](https://www.mollie.com/beheer/diensten), and let us handle the rest.
+ PHP >= 5.2 although Laravel itself requires a higher PHP version
+ PHP cURL extension
+ Up-to-date OpenSSL (or other SSL/TLS toolkit)
+ SSL v3 disabled. Mollie does not support SSL v3 anymore.

## Installation

Via Composer

``` bash
$ composer require petericebear/laravel-mollie
```

After updating composer, add the MollieServiceProvider to the providers array in config/app.php

``` php
PeterIcebear\Mollie\Providers\MollieServiceProvider::class,
```

You need to publish the config for this package. A sample configuration is provided. The defaults will be merged with gateway specific configuration.

``` bash
$ php artisan vendor:publish --provider="PeterIcebear\Mollie\Providers\MollieServiceProvider"
```

To use the Facade (`\Mollie::getMethods()` instead of `App::make('mollie')->getMethods()`), add that to the facades array.

``` php
'Mollie' => PeterIcebear\Mollie\Facades\Mollie::class,
```

## Usage of the wrapper

Creating a new payment.
	
```php
    $payment = Mollie::getPayments()->create([
        "amount"      => 10.00,
        "description" => "My first API payment",
        "redirectUrl" => "https://webshop.example.org/order/12345/",
    ]);
```
_After creation, the payment id is available in the `$payment->id` property. You should store this id with your order._

Retrieving a payment.

```php
    $payment = Mollie::getPayments()->get($payment->id);

    if ($payment->isPaid())
    {
        echo "Payment received.";
    }
```

## Fully integrated iDEAL payments

If you want to fully integrate iDEAL payments in your web site, some additional steps are required. First, you need to
retrieve the list of issuers (banks) that support iDEAL and have your customer pick the issuer he/she wants to use for
the payment.

Retrieve the list of issuers:

```php
    $issuers = Mollie::getIssuers()->all();
```

_`$issuers` will be a list of `Mollie_API_Object_Issuer` objects. Use the property `$id` of this object in the
 API call, and the property `$name` for displaying the issuer to your customer.

Create a payment with the selected issuer:

```php
    $payment = Mollie::getPayments()->create(array(
        "amount"      => 10.00,
        "description" => "My first API payment",
        "redirectUrl" => "https://webshop.example.org/order/12345/",
        "method" => Mollie_API_Object_Method::IDEAL,
        "issuer" => $selected_issuer_id, // e.g. "ideal_INGBNL2A"
    ));
```

_The `links` property of the `$payment` object will contain a string `paymentUrl`, which is a URL that points directly to the online banking environment of the selected issuer._

## Refunding payments

The API also supports refunding payments. Note that there is no confirmation and that all refunds are immediate and
definitive. Refunds are only supported for iDEAL, credit card, Bancontact/Mister Cash, SOFORT Banking and bank transfer payments. Other types of payments cannot
be refunded through our API at the moment.

```php
    $payment = Mollie::getPayments()->get($payment->id);

    // Refund € 15 of this payment
    $refund = Mollie::getPayments()->refund($payment, 15.00);
```

## More information
Please use the official documentation of Mollie of one off the following resources:
- [Official Mollie API](https://github.com/mollie/mollie-api-php)
- [Dutch Documentation](https://www.mollie.com/nl/docs/overview)
- [English Documentation](https://www.mollie.com/en/docs/overview)