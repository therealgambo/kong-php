# kong-php
A PHP7 compliant library for interacting with the Kong Gateway Admin API.

## Kong Compatibility
Currently supporting Kong >= 0.10.0

## Requirements

- [cURL](http://php.net/manual/en/book.curl.php)
- PHP 7.0+

## Installation

### Using [Composer](https://getcomposer.org)

To install kong-php with Composer, just add the following to your `composer.json` file:

```json
{
    "require-dev": {
        "therealgambo/kong-php": "0.10.*"
    }
}
```

or by running the following command:

```shell
composer require therealgambo/kong-php
```

## Usage

### PHP

Retrieving Kong node information
```php
$kong = new \TheRealGambo\Kong\Kong(KONG_URL, KONG_PORT);
$node = $kong->getNodeObject();

print_r($node->getInformation());
```

Retrieving a list of all API's on Kong
```php
$kong = new \TheRealGambo\Kong\Kong(KONG_URL, KONG_PORT);
$apis = $kong->getApiObject();

print_r($apis->list());
```

## Versions

All releases will match for the stable versions of Kong released >= 0.10.0

This ensures stability and resillence within the library reducing any compatibility issues between versions.

## License

Kong-php is open-source software and licensed under the [MIT License](http://opensource.org/licenses/MIT).

Kong is Copyright Mashape, inc.