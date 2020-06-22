<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
   public $timestamps = false;

   protected $fillable = ['name', 'group'];

   public static function createFor($group)
   {
   	$actions = ['viewAny', 'view', 'create', 'update', 'delete'];
   	$permissions = [];
   	foreach ($actions as $action) {
   		$permissions[] = [
   			'name' => $group.'.'.$action, 
   			'group' => $group
   		];
   	}
   	static::insert($permissions);
   }
}
