<?php 
namespace App\DataTypes;

use Illuminate\Support\Str;

abstract class DataType {

  public function getTableName() {
    if (isset($this->table))
      return $this->table;
   
    $class_name = (new \ReflectionClass($this))->getShortName();
    return Str::plural(strtolower($class_name));  
  }

  public function getFields() {
    
  }
}