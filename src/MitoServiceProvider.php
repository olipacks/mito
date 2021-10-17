<?php

namespace Mito;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Mito\Commands\MitoCommand;

class MitoServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('mito')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_mito_table')
            ->hasCommand(MitoCommand::class);
    }
}
