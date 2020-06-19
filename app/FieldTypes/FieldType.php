<?php 

namespace App\FieldTypes;

/**
 * 
 */
abstract class FieldType  
{
	
	protected $type;
	public $name;
	protected $required;
	protected $dbAttributes;

	function __construct($name)
	{
		$this->name = $name;
		$this->addNameDbAttribute();
		$this->required(false);
	}

	public static function create($name)
	{
		return new static($name);
	}

	public function getName()
	{
		return $this->name;
	}

	abstract function getFormField();
	
	abstract function getDbColumnType();

	public function isRequired()
	{
		return $this->required;
	}

	public function required(bool $required = true)
	{
		$this->required = $required;
		if ($required === true)
			$this->removeDbAttribute('nullable');
		else
			$this->addDbAttribute('nullable');
		return $this;
	}

	protected function addNameDbAttribute()
	{
		$this->addDbAttribute($this->getDbColumnType(), [$this->getName()]);
	}

	protected function addDbAttribute($attribute, array $values = null)
	{		 
		$this->dbAttributes[$attribute] = $values;
	}

	protected function removeDbAttribute($attribute)
	{
		unset($this->dbAttributes[$attribute]);
	}

	public function getDbAttributes()
	{
		return $this->dbAttributes;
	}
}