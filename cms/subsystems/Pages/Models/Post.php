<?php

namespace Subsystem\Pages\Models;

use App\CrudModel;
use App\DataTypes\Post as PostDatatype;

class Post extends CrudModel
{    
	protected static $datatype = PostDatatype::class;	

	public function getDisplayNameAttribute()
	{
		return $this->name;
	}
}