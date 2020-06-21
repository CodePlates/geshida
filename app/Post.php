<?php

namespace App;

use App\CrudModel;
use App\DataTypes\Post as PostDatatype;

class Post extends CrudModel
{    
	protected static $datatype = PostDatatype::class;	

	public function human()
	{
		return $this->belongsTo('App\Human');
	}

	public function tags()
	{
		return $this->belongsToMany('App\Tag');
	}

	public function getDisplayNameAttribute()
	{
		return $this->title;
	}
}