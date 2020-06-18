<?php 
namespace App\DataTypes;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\FieldTypes\FieldType;
use App\FieldTypes\FileFieldType;

abstract class DataType {

  protected $fields;
  protected $table;
  protected $langKey;
  protected $slug;

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

  public function getFields(array $fieldNames = null) 
  {
    if (is_null($fieldNames)) 
      return $this->fields;
      
    return $this->fields->only($fieldNames);
  }

  public function hasFileFields(array $fieldNames = null)
  {
    $fields = $this->getFields($fieldNames);
    return $fields->contains(function ($value, $key) {
        return ($value instanceof FileFieldType);
    });
  }

  public function getFileFields(array $fieldNames = null)
  {
    $fields = $this->getFields($fieldNames);
    return $fields->whereInstanceOf(FileFieldType::class);
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
  
  public function getSlug()
  {
    if (isset($this->slug)) 
      return $this->slug;

    return $this->getTableName();
  }

  public function getLangKey()
  {
    if (isset($this->langKey)) 
      return $this->langKey;

    return $this->getTableName();
  }
}