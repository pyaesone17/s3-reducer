<?php

namespace Pyaesone17\S3Reducer\Console;

use Illuminate\Console\Command;
use Storage;

class ClearCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 's3reducer:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the local cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Storage::disk('public')->deleteDirectory(config('filesystems.disks.s3.bucket'));
    }
}
