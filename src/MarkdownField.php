<?php

namespace Spatie\FilamentMarkdownField;

use Filament\Forms\Components\Concerns;
use Filament\Forms\Components\Contracts;
use Filament\Forms\Components\Field;

class MarkdownField extends Field implements Contracts\HasFileAttachments
{
    use Concerns\HasFileAttachments;
    use Concerns\InteractsWithToolbarButtons;

    protected string $view = 'filament-markdown-field::markdownField';

    protected array | Closure $toolbarButtons = [
        'heading',
        'bold',
        'italic',
        'link',
        'quote',
        'unordered-list',
        'ordered-list',
        'table',
        'upload-image',
        'undo',
        'redo',
    ];
}
