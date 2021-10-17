# A minimal Laravel package for blog publishing

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mitophp/mito.svg?style=flat-square)](https://packagist.org/packages/mitophp/mito)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/mitophp/mito/run-tests?label=tests)](https://github.com/mitophp/mito/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/mitophp/mito/Check%20&%20fix%20styling?label=code%20style)](https://github.com/mitophp/mito/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mitophp/mito.svg?style=flat-square)](https://packagist.org/packages/mitophp/mito)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require mitophp/mito
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Mito\MitoServiceProvider" --tag="mito-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Mito\MitoServiceProvider" --tag="mito-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$mito = new Mito\Mito();
echo $mito->echoPhrase('Hello, Mito!');
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

- [Oliver Servín](https://github.com/oliverds)
- [All Contributors](../../contributors)

## License

The AGPL License (AGPL-3.0). Please see [License File](LICENSE.md) for more information.
