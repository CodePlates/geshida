<?php

namespace App;

use App\CrudModel;
use App\DataTypes\User as UserDatatype;

class User extends CrudModel
{    
	protected static $datatype = UserDatatype::class;	

	protected $hidden = [
		'password', 'remember_token',
  	];

	public function role()
	{
		return $this->belongsTo('App\Role');
	}

	public function getFullNameAttribute()
	{
		return "{$this->first_name} {$this->last_name}";
	}

	public function getDisplayNameAttribute()
	{
		return $this->full_name;
	}
}