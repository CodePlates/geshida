<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrudModel extends Model{

	public function getDataType()
	{
		if (isset($this->datatype))
			return $this->datatype;

		$class_name = (new \ReflectionClass($this))->getShortName();
		return $class_name;
	}
}