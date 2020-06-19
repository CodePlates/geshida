<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Crud::register(\App\Post::class, 'App\Http\Controllers\PostController');
        \App\Crud::register(\App\Page::class, 'App\Http\Controllers\PageController');
        \App\Crud::register(\App\Human::class, 'App\Http\Controllers\HumanController');
    }
}
