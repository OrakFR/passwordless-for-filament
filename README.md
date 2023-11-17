# This is my package passwordless-for-filament

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bpincaro/passwordless-for-filament.svg?style=flat-square)](https://packagist.org/packages/bpincaro/passwordless-for-filament)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/bpincaro/passwordless-for-filament/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/bpincaro/passwordless-for-filament/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/bpincaro/passwordless-for-filament/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/bpincaro/passwordless-for-filament/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/bpincaro/passwordless-for-filament.svg?style=flat-square)](https://packagist.org/packages/bpincaro/passwordless-for-filament)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require bpincaro/passwordless-for-filament
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="passwordless-for-filament-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="passwordless-for-filament-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="passwordless-for-filament-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$passwordlessForFilament = new BrunoPincaro\PasswordlessForFilament();
echo $passwordlessForFilament->echoPhrase('Hello, BrunoPincaro!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Bruno Pincaro](https://github.com/bpincaro)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
