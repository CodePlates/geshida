<?php 

use App\Datatypes\DataType;

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