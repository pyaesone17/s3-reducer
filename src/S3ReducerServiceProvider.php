<?php

namespace Pyaesone17\S3Reducer;

use Illuminate\Support\ServiceProvider;

class S3ReducerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMain();
        $this->registerCommands();
    }

    public function registerMain()
    {
        $this->app->singleton('Pyaesone17\S3Reducer\Reducer', function ($app) {
            return new Reducer($app['config']->get('filesystems.disks.s3.bucket'));
        });
    }

    /**
     * Register the console command to clear lapses.
     *
     * @return void
     */
    public function registerCommands()
    {
        $this->commands([
            Console\ClearCacheCommand::class
        ]);
    }
}