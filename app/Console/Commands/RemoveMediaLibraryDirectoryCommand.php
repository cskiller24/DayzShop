<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RemoveMediaLibraryDirectoryCommand extends Command
{
    protected $signature = 'remove:media-library-directory';

    protected $description = 'Command description';

    public function handle(): void
    {
        throw_if(app()->isProduction(), \Exception::class, message: 'Cannot remove directory on production env.');

        $directories = Storage::disk('public')->directories();

        foreach ($directories as $directory) {
            Storage::disk('public')->deleteDirectory($directory);
        }

        $this->info('Remove all directories in public disks');
    }
}
