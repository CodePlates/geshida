<?php

namespace App;

use App\CrudModel;
use App\DataTypes\Role as RoleDatatype;

class Role extends CrudModel
{    
	protected static $datatype = RoleDatatype::class;	


}