<?php 
namespace App\DataTypes;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\FieldTypes\FieldType;
use App\FieldTypes\FileFieldType;

abstract class DataType {

  protected $fields;
  protected $table;
  protected $langKey;
  protected $slug;
  protected $displayNameField;

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

  public static function hasFileFields(Collection $fields)
  {
    return $fields->contains(function ($value, $key) {
        return ($value instanceof FileFieldType);
    });
  }

  public static function getFileFields(array $fields)
  {
    return $fields->whereInstanceOf(FileFieldType::class);
  }

  public function getField(string $fieldName) 
  {
    return $this->fields->get($fieldName);
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

  public function getDisplayNameField()
  {
    return Arr::first($this->getFieldNames(), function ($fieldName) {
      return in_array(strtolower($fieldName), ['name', 'title']);
    }, 'id');
    
  }
}