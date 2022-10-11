<?php

namespace Spatie\A markdown field for Filament;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\A markdown field for Filament\Commands\A markdown field for FilamentCommand;

class A markdown field for FilamentServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-markdown-field')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament-markdown-field_table')
            ->hasCommand(A markdown field for FilamentCommand::class);
    }
}
