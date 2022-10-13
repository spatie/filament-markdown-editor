<?php

use Livewire\Livewire;
use Spatie\FilamentMarkdownEditor\Tests\TestSupport\TestFormComponent;

it('can render the component', function () {
    Livewire::test(TestFormComponent::class)->assertSeeHtml('editor');
});
