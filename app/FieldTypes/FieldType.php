<?php 

namespace App\FieldTypes;

/**
 * 
 */
abstract class FieldType  
{
	
	protected $type;
	public $name;

	function __construct($name)
	{
		$this->name = $name;
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
}