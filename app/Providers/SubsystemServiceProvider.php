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
        $subsystems = Subsystem::getEnabled();
        foreach ($subsystems as $subsystemData) {  
            $this->loadSubsystemRoutes($subsystemData);       
            $subsystem = Subsystem::resolve($subsystemData->name);
            $subsystem->boot();
        }
    }


    protected function loadSubsystemRoutes($subsystemData)
    {
        $name = $subsystemData->name;
        $routefile = base_path("cms/subsystems/{$name}/routes/web.php");
        $namespace = "Subsystem\\$name\\App\\Http\\Controllers";
        if (file_exists($routefile)) {
            Route::namespace($namespace)
                ->prefix($subsystemData->route)
                ->middleware('web')
                ->group($routefile); 
                       
        }
    }
}
