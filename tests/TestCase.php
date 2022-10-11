<?php

namespace Spatie\FilamentMarkdownField\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\FilamentMarkdownField\MarkdownFieldServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            MarkdownFieldServiceProvider::class,
        ];
    }
}
