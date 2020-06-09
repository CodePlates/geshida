<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrudModel extends Model{

	public static function getDataType()
	{
		if (isset(static::$datatype))
			return static::$datatype;

		$class_name = (new \ReflectionClass(static::class))->getShortName();
		return $class_name;
	}
}