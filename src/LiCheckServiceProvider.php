<?php

use Illuminate\Support\ServiceProvider;

class LiCheckServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__."/config" => config_path(),
            __DIR__."/Exceptions" => app_path()."/Exceptions",
        ]);
    }
}
