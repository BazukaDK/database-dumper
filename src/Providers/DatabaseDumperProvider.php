<?php

namespace Bazuka\DatabaseDumper\Providers;

use Illuminate\Support\ServiceProvider;
use Bazuka\DatabaseDumper\Commands\DatabaseDump;

class DatabaseDumperProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                DatabaseDump::class,
            ]);
        }
    }
}
