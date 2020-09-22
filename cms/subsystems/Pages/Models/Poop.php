<?php

namespace Subsystem\Pages\Models;

use App\CrudModel;
use App\DataTypes\Poop as PoopDatatype;

class Poop extends CrudModel
{    
	protected static $datatype = PoopDatatype::class;	

	public function getDisplayNameAttribute()
	{
		return $this->name;
	}
}