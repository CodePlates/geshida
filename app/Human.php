<?php

namespace App;

use App\CrudModel;
use App\DataTypes\Human as HumanDatatype;

class Human extends CrudModel
{    
   protected static $datatype = HumanDatatype::class;

   public function getDisplayNameAttribute()
   {
   	return $this->name;
   }
   
}