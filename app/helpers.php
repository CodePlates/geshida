<?php 

use App\Crud;
use App\CrudModel;
use App\Subsystem;
use App\Datatypes\DataType;
use App\FieldTypes\FieldType;


if (! function_exists('label')) {

	function label(DataType $datatype, string $key)
	{
		return __($datatype->getLangKey().'.'.$key);
	}
}

if (! function_exists('field_label')) {

	function field_label(DataType $datatype, FieldType $field)
	{
		return __($datatype->getLangKey().'.'.$field->getName());
	}
}

if (! function_exists('crud_route')) {

	function crud_route(string $action, $model)
	{
		if ($model instanceof CrudModel) {
			$routeSlug = Crud::getSlug(get_class($model));
			return route("{$routeSlug}.{$action}",[$model]);
		} elseif (is_string($model) && is_subclass_of($model, CrudModel::class)) {
			$routeSlug = Crud::getSlug($model);
			return route("{$routeSlug}.{$action}");
		} else {						
			$className = (is_object($model)) ? get_class($model) : $model;
			$error = "Unsupported model passed to crud_route(): ".$className;
			$error .= ", Expected instance or subclass of CrudModel";
			throw new Exception($error);
			
		}
	}
}

if (! function_exists('dashboard_view')) {

	function dashboard_view(string $view, $crud) 
	{
		$slug = $crud->datatype()->getSlug();
		return view()->first(
			["{$slug}.{$view}", "crud.{$view}"], 
			$crud->getData()
		);
	}
}

if (! function_exists('theme_view')) {

	function theme_view($view, $data = [], $mergeData = [])
	{
		$subsystemData = Subsystem::$currentSubsystemData;
		$theme = $subsystemData->theme;
		if ($theme == 'default')
			$theme .= '.'.$subsystemData->name; 
		$view = "geshida::${theme}.${view}";
		return view($view, $data, $mergeData);
	}
}