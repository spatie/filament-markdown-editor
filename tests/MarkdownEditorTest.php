<?php

use Livewire\Livewire;
use Spatie\FilamentMarkdownEditor\MarkdownEditor;
use Spatie\FilamentMarkdownEditor\Tests\TestSupport\TestFormComponent;
use Spatie\FilamentMarkdownEditor\Tests\TestSupport\TestFormPlaceholderComponent;

it('can render the component', function () {
    Livewire::test(TestFormComponent::class)
        ->assertSeeHtml('editor');
});

it('can render the component with a great placeholder', function () {
    $test = Livewire::test(TestFormPlaceholderComponent::class)
        ->assertSeeHtml("placeholder: 'Pikachu'");
});
