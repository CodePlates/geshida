<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
   
   public function menu()
   {
   	return $this->belongsTo('App\Menu');
   }

   public function children()
   {
   	return $this->hasMany('App\MenuItem', 'parent_id');
   }
}
