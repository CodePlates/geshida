<?php 
namespace App\DataTypes;

use App\FieldsCollection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\FieldTypes\FieldType;

abstract class DataType {

  protected $fields;
  protected $table;
  protected $langKey;
  protected $slug;
  protected $displayNameField;

  function __construct()
  {
    $this->fields = new FieldsCollection($this->build());
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

  public function getAllFields() 
  {    
    return $this->fields;    
  }  

  public function getField(string $fieldName) 
  {
    return $this->fields->get($fieldName);
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
    $fieldnames = $this->fields->getNames();
    return Arr::first(
      ['display_name', 'name', 'title'],
      function ($name) use ($fieldnames) {
        return $fieldnames->contains(strtolower($name));
      }, 'id'
    );  
  }
}