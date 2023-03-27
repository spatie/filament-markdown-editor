<?php

namespace Spatie\FilamentMarkdownEditor\Tests\TestSupport;

use Spatie\FilamentMarkdownEditor\MarkdownEditor;

class TestFormPlaceholderComponent extends TestFormComponent
{
    protected function getFormSchema(): array
    {
        return [
            MarkdownEditor::make('content')->placeholder('Pikachu'),
        ];
    }
}
