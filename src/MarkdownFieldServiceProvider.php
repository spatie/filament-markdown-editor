<?php

namespace Spatie\FilamentMarkdownField;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\FilamentMarkdownField\Commands\FilamentMarkdownFieldCommand;

class MarkdownFieldServiceProvider extends PackageServiceProvider
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
            ->hasCommand(FilamentMarkdownFieldCommand::class);
    }
}
