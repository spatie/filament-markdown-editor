<?php

namespace Spatie\FilamentMarkdownEditor\Tests;

use Filament\FilamentServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\FilamentMarkdownEditor\MarkdownEditorServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            FilamentServiceProvider::class,
            LivewireServiceProvider::class,
            MarkdownEditorServiceProvider::class,
        ];
    }
}
