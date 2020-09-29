# achbanking-php

## Installation

You can install **achbanking-php** via composer or by downloading the source.

### Via Composer:

**achbanking-php** is available on Packagist as the
[`achbanking/sdk`](https://packagist.org/packages/achbanking/sdk) package:

```
composer require achbanking/sdk
```

## Quickstart

### Connect

```php
// Via constructor
<?php

$client = new \AchBanking\Sdk\Client(
    'API_TOKEN',
    'API_KEY',
    'https://dev.achbanking.com/api/'
);
```

```php
// Or set credentials later
<?php

$client = new \AchBanking\Sdk\Client();
$client->useCredentials(
    'API_TOKEN',
    'API_KEY',
    'https://dev.achbanking.com/api/'
);
```

### Make API request

```php
<?php

$result = $client->methodName([
    'param1' => 'value1',
    'param2' => 'value2',
    'param3' => 'value3',
]);

// for example, get payment profile by ID
$result = $client->getPaymentProfile([
    'payment_profile_id' => 'payment-profile-id',
]);
```

Full list of available requests [HERE](https://achbanking.com/apiDoc/#endpointsDirectly).
