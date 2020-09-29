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

| | Endpoint URL | Details |
| --- | --- | --- |
| Sandbox | `https://dev.achbanking.com/api/` | Has IP restrictions |
| Production | `https://achbanking.com/api/` | |

```php
// Via constructor
<?php

$client = new \AchBanking\Sdk\Client(
    'API_TOKEN', // from the site
    'API_KEY', // from the site
    'ENDPOINT_URL'
);
```

```php
// Or set credentials later
<?php

$client = new \AchBanking\Sdk\Client();
$client->useCredentials(
    'API_TOKEN',
    'API_KEY',
    'ENDPOINT_URL'
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
