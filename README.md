[![Build Status](https://travis-ci.org/opendns/merchant-esolutions-php.svg?branch=master)](https://travis-ci.org/opendns/merchant-esolutions-php)

# Introduction
merchant-esolutions-php is designed to make it easier to use the various payment
APIs provided by Merchant e-Solutions.

If you find any bugs, or have feature requests, please file an issue in
[GitHub](https://github.com/opendns/merchant-esolutions-php) or open a pull
request.

# Installation

## Composer
Ensure that composer is [installed on your machine](https://getcomposer.org/doc/00-intro.md).
You will need to create a `composer.json` file in the root
directory of your application.
```json
{
    "require": {
        "opendns/merchant-solutions-php": "~0.1"
    }
}
```

Once the `composer.json` file is created, follow these steps from composer to
[install the merchant-esolutions-php package](https://getcomposer.org/doc/00-intro.md#using-composer).

Composer creates its own autoloader. Include
`vendor/autoload.php` in your application config file and
you will have full access to the merchant-esolutions-php client.

# APIs
This readme has a short description of the APIs and an example of each, but there's also a [full api reference](http://opendns.github.io/merchant-esolutions-php/) available on this project's Github page.

## Trident
Trident is the payment gateway API, providing most card operations. A simple
transaction might look like this:

```php
use OpenDNS\MES\Trident\Sale;

$response = Sale::factory(Sale::ENV_TEST)
    ->setAuthenticationInfo('xxxxxxxxxxx', 'yyyyyyy')
    ->setAmount(13.37)
    ->setCardNumber('3499-999999-99991')
    ->setCardExpiration(12, 2018)
    ->setCvv2(1234)
    ->execute();

echo $response['transaction_id'];
```

## Reporting
The reporting API offers full access to any of the MeS gateway's reports as CSV
data. Here's a sample report:

```php
use OpenDNS\MES\Reporting\Report;

$response = Report::factory(Report::ENV_PROD)
    ->setAuthenticationInfo('xxxxxxxxxxx', 'yyyyyyy')
    ->setNodeId('zzzzzzzzzz')
    ->setReportId(Report::REPORT_SETTLEMENT_SUMMARY)
    ->setBeginDate(new \DateTime('-1 week', new \DateTimeZone('UTC')))
    ->setEndDate(new \DateTime('now', new \DateTimeZone('UTC')))
    ->setIncludeTridentTransactionId(true)
    ->execute();

$stream = $response->getResponseBodyStream();
while ($row = fgetcsv($stream)) {
    echo implode(',', $row);
}
```

## Recurring Billing
The recurring billing API allows you to create and manage recurring billing
profiles.

_Note: If you're building a new application, it's probably better to use the Trident API to store a card and issue additional Sale transactions against it_

_Further Note: The recurring billing API support is experimental, please feel free to open bugs/pull requests if you find yourself using it._

