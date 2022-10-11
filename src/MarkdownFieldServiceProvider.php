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
            ->hasAssets()
            ->hasViews();
    }

    public function bootingPackage()
    {
        Filament::registerScripts([
            url('vendor/filament-markdown-field/editor.js'),
        ]);


    }
}
