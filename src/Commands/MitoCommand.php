<?php

namespace Mito\Commands;

use Illuminate\Console\Command;

class MitoCommand extends Command
{
    public $signature = 'mito';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
