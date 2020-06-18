<?php 
namespace App\DataTypes;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\FieldTypes\FieldType;

abstract class DataType {

  protected $fields;

  function __construct()
  {
    $this->fields = collect($this->build())->keyBy('name');
  }

  /**
   * @return array
   */
  abstract protected function build();
  
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
    return $this->fields->get($fieldName);
  }

  public function getFormField($fieldName)
  {
    return $this->getField($fieldName)->getFormField();
  }

  public function getFieldNames()
  {
    return $this->fields->keys()->all();
  }

  public function getName()
  {
    return $this->getTableName();
  }
}