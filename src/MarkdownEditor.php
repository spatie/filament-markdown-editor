<?php

namespace Spatie\FilamentMarkdownEditor;

use Closure;
use Filament\Forms\Components\Concerns;
use Filament\Forms\Components\Contracts;
use Filament\Forms\Components\Field;

class MarkdownEditor extends Field implements Contracts\HasFileAttachments
{
    use Concerns\HasFileAttachments;
    use Concerns\HasPlaceholder;
    use Concerns\InteractsWithToolbarButtons;

    protected string $view = 'filament-markdown-editor::markdownField';

    protected array|Closure $toolbarButtons = [
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
