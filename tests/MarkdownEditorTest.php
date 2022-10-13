<?php

use Filament\Forms\ComponentContainer;
use Spatie\FilamentMarkdownEditor\MarkdownEditor;
use Spatie\FilamentMarkdownEditor\Tests\TestSupport\Livewire;

it('can render the component', function () {
    $container = ComponentContainer::make(Livewire::make());

    $renderedEditor = (string) MarkdownEditor::make('my-editor')->container($container)->render();

    expect($renderedEditor)->toBeString();
});
