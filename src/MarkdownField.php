<?php

namespace Spatie\FilamentMarkdownField;

use Filament\Forms\Components\Concerns;
use Filament\Forms\Components\Contracts;
use Filament\Forms\Components\Field;

class MarkdownField extends Field implements Contracts\HasFileAttachments
{
    use Concerns\HasFileAttachments;

    protected string $view = 'filament-markdown-field::markdownField';
}
