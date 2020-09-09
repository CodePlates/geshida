<?php 

namespace App;

use Storage;
use Settings;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\DatabaseMigrationRepository;

/**
 * 
 */
abstract class Subsystem extends ServiceProvider
{

	protected $name;

	protected $display_name;

	protected $prefferedRoutes = [];

	protected $migrations = "database/migrations";

	protected $routesFile = "routes/web.php";

	private static $table = "subsystems";

	public static $currentSubsystemData;

	
	
	public function __construct()
	{
		
	}

	public function boot()
	{
		
	}

	public static function resolve($name)
	{
		//FIXME: use the namespaces
		$class = $name."Subsystem";
		$filesystem = app()->make(Filesystem::class);
		$subsystemFile = $filesystem->requireOnce(base_path("cms/subsystems/$name/{$class}.php"));
		return new $class;
	}

	public function getPreferredRoutes()
	{
		return $this->prefferedRoutes ?? [];
	}

	protected function getMigrationsPath()
	{
		return base_path("cms/subsystems/{$this->name}/{$this->migrations}");
	}

	public function install() 
	{
		$migrator = app()->make('subsystem.migrator');
		$migrator->subsystem = $this->name;
		$migrator->run($this->getMigrationsPath());
		$migrator->subsystem = null;
		//
		//
		DB::table(self::$table)->insert([
			'name' => $this->name,
			'display_name' => $this->display_name ?? $this->name,
			'installed' => true,
		]);
	}

	public function enable()
	{
		$routes = static::getRoutes();
		$route = Arr::first(
			$this->getPreferredRoutes(), 
			function($value) use($routes){
				return !$routes->contains($value);
			}, 
			$this->name.time()
		);	

		DB::table(self::$table)->where('name', $this->name)->update([
			'enabled' => true,
			'route' => $route,
		]);
	}

	public static function getEnabled()
	{
		if (\Schema::hasTable(self::$table))
			return DB::table(self::$table)->where('enabled', true)->get();
		else return collect([]);
	}

	public static function getRoutes()
	{
		return static::getEnabled()->pluck('route');
	}

	// public function subsystemPath($path = "")
	// {
	// 	return "cms/subsystems/{$this->name}/$path";
	// }

	// public function migrationsPath()
	// {
	// 	return $this->subsystemPath($this->migrations);
	// }

	// public function getName()
	// {
	// 	return $this->name;
	// }

	// public function install()
	// {
	// 	$migrator = new \App\Migrator;
	// 	$migrator->run($this->migrationsPath());
	// }

	// public function uninstall()
	// {

	// }

	// public function enable()
	// {

	// }

	// public function disable()
	// {

	// }

	

	// public static function getFolderSubsystems()
	// {
	// 	$directories = Storage::disk('subsystems')->directories();
	// 	$subsystems = [];
	// 	$active_subsystems = Settings::get('active_subsystems', []);
	// 	$installed_subsystems = Settings::get('installed_subsystems', []);

	// 	foreach ($directories as $subsystemName) {
	// 		$subsystem_json = $subsystemName."/subsystem.json";
	// 		if(Storage::disk('subsystems')->exists($subsystem_json)) {
	// 			$json = Storage::disk('subsystems')->get($subsystem_json);
	// 				$subsystem = json_decode($json);
	// 				$subsystem->installed = in_array($subsystemName, $installed_subsystems);
	// 				$subsystem->active = in_array($subsystemName, $active_subsystems);
	// 				// if (isset($active_subsystems[$subsystemName])) {
	// 				// 	array_merge(
	// 				// 		$subsystems[$subsystemName], 
	// 				// 		$active_subsystems[$subsystemName]
	// 				// 	); 
	// 				// }
	// 				$subsystems[$subsystemName] = $subsystem;
	// 		} else {
	// 			// TODO: message invalid subsytem detected
	// 		}	
	// 	}

	// 	return $subsystems;
	// }


}