<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\DatatypeMigrationCreator;
use App\Crud;
use App\SettingsManager;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('settings', function() {
         return new SettingsManager();
      });
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
		
		Crud::register(\App\Tag::class, 'App\Http\Controllers\TagController');
		Crud::register(\App\Post::class, 'App\Http\Controllers\PostController');
		Crud::register(\App\Page::class, 'App\Http\Controllers\PageController');
		Crud::register(\App\Human::class, 'App\Http\Controllers\HumanController');

		Crud::register(\App\Role::class, 'App\Http\Controllers\RoleController');
		Crud::register(\App\User::class, 'App\Http\Controllers\UserController');

		View::composer('partials.sidebar', function ($view) {
			$view->with(['cruds' => \App\Crud::getModels()]);
		});
	}
}
