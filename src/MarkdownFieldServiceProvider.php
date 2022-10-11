<?php

namespace Spatie\FilamentMarkdownField;

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
