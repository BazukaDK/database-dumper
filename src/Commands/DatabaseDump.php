<?php

namespace Bazuka\DatabaseDumper\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use File;

class DatabaseDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a copy of the database and add it to storage/app/backups.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = env('DB_DUMP_NAME', 'backup-' . Carbon::now()->format('Y-m-d')) . '.sql';
        $storageAt = storage_path() . '/app/backup/';

        if (!File::exists($storageAt)) {
            File::makeDirectory($storageAt, 0755, true, true);
        }

        $command = 
            env('DB_DUMP_PATH', 'mysqldump').' --user=' . 
            env('DB_USERNAME') .' --password=' . 
            env('DB_PASSWORD') . ' --host=' . 
            env('DB_HOST') . ' ' . 
            env('DB_DATABASE') . ' --no-tablespaces | gzip > ' . $storageAt . $filename;

        exec($command);
    }
}
