<?php

use Spatie\FilamentMarkdownEditor\MarkdownEditor;

it('can render the component', function () {
    expect((string) MarkdownEditor::make('my-editor')->render())->toBeString();
});
