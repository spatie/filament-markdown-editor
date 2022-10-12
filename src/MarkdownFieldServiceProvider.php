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
            'markdown-field' => __DIR__ . '/../resources/dist/editor.js',
        ], true);

        Filament::registerStyles([
            'https://pro.fontawesome.com/releases/v5.15.4/css/all.css',
            'https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css',
        ]);
    }
}
