<?php 

use App\Datatypes\DataType;
use App\CrudModel;
use App\Crud;

if (! function_exists('label')) {

	function label(DataType $datatype, string $key)
	{
		return __($datatype->getLangKey().'.'.$key);
	}
}

if (! function_exists('field_label')) {

	function field_label(DataType $datatype, string $fieldName)
	{
		return __($datatype->getLangKey().'.'.$fieldName);
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