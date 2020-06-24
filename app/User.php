<?php

namespace App;

use App\CrudModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use App\DataTypes\User as UserDatatype;

class User extends CrudModel implements
    AuthenticatableContract,
    AuthorizableContract
{    

	use Authenticatable, Authorizable;

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

	public function hasPermission(string $permission)
	{
		return $this->role->permissions->contains('name', $permission);
	}
}