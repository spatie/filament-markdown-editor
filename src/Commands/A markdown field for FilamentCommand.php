<?php

namespace Spatie\A markdown field for Filament\Commands;

use Illuminate\Console\Command;

class A markdown field for FilamentCommand extends Command
{
    public $signature = 'filament-markdown-field';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
