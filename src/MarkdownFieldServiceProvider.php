<?php

namespace Spatie\FilamentMarkdownField;

use Filament\Facades\Filament;
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

    public function bootingPackage()
    {
        Filament::registerScripts([
            __DIR__ . '../resources/js/editor.js',
        ]);
    }
}
