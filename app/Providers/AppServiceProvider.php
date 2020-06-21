<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\DatatypeMigrationCreator;

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
        // $this->app->bind('App\DatatypeMigrationCreator', function ($app) {
        //     return new DatatypeMigrationCreator(
        //         $app->make('Illuminate\Filesystem\Filesystem'),
        //         $app->make('Illuminate\Database\Migrations\MigrationCreator')
        //     );
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        \App\Crud::register(\App\Tag::class, 'App\Http\Controllers\TagController');
        \App\Crud::register(\App\Post::class, 'App\Http\Controllers\PostController');
        \App\Crud::register(\App\Page::class, 'App\Http\Controllers\PageController');
        \App\Crud::register(\App\Human::class, 'App\Http\Controllers\HumanController');
    }
}
