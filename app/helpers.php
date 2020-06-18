<?php 

use App\Datatypes\DataType;
use App\CrudModel;

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
			$routeSlug = $model->getDataType()->getName();
			return route("{$routeSlug}.{$action}",[$model]);
		} elseif (is_string($model) && is_subclass_of($model, CrudModel::class)) {
			$routeSlug = $model::getDataType()->getName();
			return route("{$routeSlug}.{$action}");
		} else {			
			throw new Exception("Unsupported model passed to crud_route(): ".print_r($model));
			
		}
	}
}