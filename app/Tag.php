<?php

namespace App;

use App\CrudModel;
use App\DataTypes\Tag as TagDatatype;

class Tag extends CrudModel
{    
	protected static $datatype = TagDatatype::class;
	

	public function getDisplayNameAttribute()
	{
		return $this->name;
	}
}