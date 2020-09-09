<?php

namespace App\Providers;

use App\Facades\Settings;
use App\Subsystem;
use Illuminate\Support\Facades\Route;
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
        $subsystems = Settings::get('active_subsystems', []);
        foreach ($subsystems as $subsystemName) {   
            $this->loadSubsystemRoutes($subsystemName);       
            $subsystem = Subsystem::resolve($subsystemName);
            $subsystem->boot();
        }
    }

   
    protected function loadSubsystemRoutes($subsystemName)
    {
        $routefile = base_path("cms/subsystems/{$subsystemName}/routes/web.php");
        $namespace = "Subsystem\\$subsystemName\\App\\Http\\Controllers";
        if (file_exists($routefile)) {
            Route::namespace($namespace)->group(function() use ($routefile) {
                $this->loadRoutesFrom($routefile);            
            });
        }
    }
}
