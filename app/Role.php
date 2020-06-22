<?php

namespace App;

use App\CrudModel;
use App\Permission;
use App\DataTypes\Role as RoleDatatype;

class Role extends CrudModel
{    
	protected static $datatype = RoleDatatype::class;	

	public function getDisplayNameAttribute()
	{
		return $this->attributes['display_name'];
	}

	public function permissions()
	{
		return $this->belongsToMany(Permission::class, 'role_permissions');
	}

	public function addPermission($permission)
	{
		if ($permission instanceof Permission)
			$this->permissions()->save($permission);
		elseif (is_string($permission)) {
			$permission = Permission::where('name', $permission)->firstOrFail();
			$this->permissions()->save($permission);
		}
	}

	public function addPermissions($permissions = [])
	{
		foreach ($permissions as $permission) {
			$this->addPermission($permission);
		}
	}
}