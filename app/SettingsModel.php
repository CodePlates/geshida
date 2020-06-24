<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingsModel extends Model
{
   protected $table = 'settings';

   public $timestamps = false;

   protected $casts = [
      'value' => 'array',
   ];

   protected $fillable = ['key', 'value'];
}
