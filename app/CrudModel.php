<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrudModel extends Model 
{

	private static function getDataTypeClass() 
	{
		if (isset(static::$datatype)) 
			return static::$datatype;
		
		$class_name = (new \ReflectionClass(static::class))->getShortName();
		return "App\\DataTypes\\$class_name";		
	}

	public static function getDataType()
	{
		static $datatype = null;
		if (is_null($datatype)) {
			$class_name = static::getDataTypeClass();	
			$datatype = new $class_name;	
		}

		return $datatype;
	}
}