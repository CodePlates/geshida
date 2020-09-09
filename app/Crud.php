<?php 

namespace App;

use App\CrudModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

class Crud {

	protected static $models = [];

	public static function register(string $modelClass, $controller, $options = [])
	{
		if (!is_subclass_of($modelClass, CrudModel::class)) {
			$error = "Unsupported model passed to Crud::register(): ".$modelClass;
			$error .= ", Expected subclass of CrudModel";
			throw new \Exception($error);
		}
			
		$datatype = $modelClass::getDataType();	
		$slug = $datatype->getSlug();	

		self::$models[$modelClass] = [
			'controller'	=> $controller,
			'options'		=> static::fillOptions($options),
			'model'			=> $modelClass,
			'slug'			=> $slug,
		];

		Route::resource($slug, $controller)->middleware(['web','auth']);
	}

	public static function getSlug(string $modelClass)
	{
		return static::$models[$modelClass]['slug'];
	}


	public static function getModels() 
	{
		return self::$models;
	}

	protected static function fillOptions(array $options)
	{
		return array_merge([
			'show_in_menu' => true,
		], $options);
	}

	

}