<?php 

namespace App;

use App\CrudModel;
use Illuminate\Support\Str;

class Crud {

	protected static $models = [];

	public static function register(string $model, $controller, $options = [])
	{
		if (!is_subclass_of($model, CrudModel::class)) {
			$error = "Unsupported model passed to Crud::register(): ".$model;
			$error .= ", Expected subclass of CrudModel";
			throw new Exception($error);
		}
			
		$datatype = $model::getDataType();		

		self::$models[$model] = [
			'controller'	=> $controller,
			'options'		=> static::fillOptions($options),
			'model'			=> $model,
		];

		\Route::resource($datatype->getSlug(), $controller);
	}


	public static function getModels() {
		return self::$models;
	}

	protected static function fillOptions(array $options)
	{
		return array_merge([
			'show_in_menu' => true,
		], $options);
	}

}