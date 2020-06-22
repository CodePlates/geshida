<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrudModel extends Model 
{

	protected static $datatype;

	private static function getDataTypeClass() 
	{
		if (isset(static::$datatype)) 
			return static::$datatype;
		
		$class_name = (new \ReflectionClass(static::class))->getShortName();
		return "App\\DataTypes\\$class_name";		
	}

	public static function getDataType()
	{
		static $datatypeObj = null;
		if (is_null($datatypeObj)) {
			$class_name = static::getDataTypeClass();	
			$datatypeObj = new $class_name;	
		}

		return $datatypeObj;
	}	
	
}