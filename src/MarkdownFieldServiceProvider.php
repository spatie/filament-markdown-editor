<?php

namespace Spatie\FilamentMarkdownField;

use Spatie\FilamentMarkdownField\Commands\FilamentMarkdownFieldCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MarkdownFieldServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-markdown-field')
            ->hasConfigFile()
            ->hasViews();
    }
}
