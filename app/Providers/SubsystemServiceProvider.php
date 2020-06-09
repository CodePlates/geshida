<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SubsystemServiceProvider extends ServiceProvider
{

    protected $cruds = [];

    public function registerCrud($name)
    {
        $cruds[] = $name;
    } 
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
        //
    }
}
