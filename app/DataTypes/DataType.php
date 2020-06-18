<?php 
namespace App\DataTypes;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;


abstract class DataType {

  public function getTableName() 
  {
    if (isset($this->table))
      return $this->table;

    $class_name = (new \ReflectionClass($this))->getShortName();
    return Str::plural(strtolower($class_name));  
  }

  public function getFields() 
  {
    return $this->fields ?? [];
  }

  public function getField($fieldName) 
  {
    foreach ($this->getFields() as $field) {
      if ($field['name'] == $fieldName)
        return $field;
    }
  }

  public function getFieldType($fieldName)
  {
    return $this->getField($fieldName)['type'];
  }

  public function getFieldNames()
  {
    return Arr::pluck($this->getFields(), 'name');
  }

  public function getName()
  {
    return $this->getTableName();
  }
}