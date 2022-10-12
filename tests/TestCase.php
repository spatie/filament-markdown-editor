<?php

namespace Spatie\FilamentMarkdownEditor\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\FilamentMarkdownEditor\MarkdownEditorServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            MarkdownEditorServiceProvider::class,
        ];
    }
}
