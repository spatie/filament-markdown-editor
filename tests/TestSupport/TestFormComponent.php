<?php

namespace Spatie\FilamentMarkdownEditor\Tests\TestSupport;

use Filament\Forms;
use Livewire\Component;
use Spatie\FilamentMarkdownEditor\MarkdownEditor;

class TestFormComponent extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected function getFormSchema(): array
    {
        return [
            MarkdownEditor::make('content'),
        ];
    }

    public function render()
    {
        return <<<'blade'
            <form wire:submit.prevent="submit">
                {{ $this->form }}

                <button type="submit">
                    Submit
                </button>
            </form>
        blade;
    }
}
