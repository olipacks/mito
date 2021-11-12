# A minimal Laravel package for blog publishing

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mitophp/mito.svg?style=flat-square)](https://packagist.org/packages/mitophp/mito)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/mitophp/mito/run-tests?label=tests)](https://github.com/mitophp/mito/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/mitophp/mito/Check%20&%20fix%20styling?label=code%20style)](https://github.com/mitophp/mito/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mitophp/mito.svg?style=flat-square)](https://packagist.org/packages/mitophp/mito)

Mito is a blog publishing platform with a minimal UI to manage a markdown blog publication into a new or existent Laravel project.

Mito does not provide its own blog front-end interface, but you may use the `Mito\Models\Post` model to get or display your content in controllers or views.

You may also review or use the [Personal Blog](https://github.com/mitophp/starter-kit-personal-blog) starter kit as a starting point for a Laravel blog integrated with Mito.

https://user-images.githubusercontent.com/7003648/138785945-59cb4c6d-e401-4097-98d2-6fb50c34565b.mp4

## Demo

You can test and try Mito dashboard on [our demo site](https://demo.mitophp.com).

## Installation

You may use Composer to install Mito into your new or existent Laravel project:

```bash
composer require mitophp/mito
```

After installing Mito, you may publish its resources using the `vendor:publish` Artisan command:

```bash
php artisan vendor:publish --tag mito-migrations
php artisan vendor:publish --tag mito-assets
```

Finally, run the `migrate` Artisan command:

```bash
php artisan migrate
```

### Visit the Dashboard

After performing all these steps, you should be able to visit the Mito Dashboard at `/mito`.

### Schedule the command

In the console kernel, you should schedule the `mito:publish-scheduled-posts` command.

```php
// in app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    // ...
    $schedule->command('mito:publish-scheduled-posts')->everyMinute();
}
```

## Updates

After each update, make sure you run these commands:

```bash
php artisan vendor:publish --tag mito-assets --force
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

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
