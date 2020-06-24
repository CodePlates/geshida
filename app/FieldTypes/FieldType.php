<?php 

namespace App\FieldTypes;

use App\FieldTypes\Relationship\Relationship;
/**
 * 
 */
abstract class FieldType  
{
	
	protected $type;
	public $name;
	protected $required;
	protected $dbAttributes;
	protected $model;
	private $relationship;
	protected $hasRelationship = false;
	protected $dbColumnName;

	function __construct($name)
	{
		$this->name = $name;
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

	public function getDbColumnName()
	{					
		return $this->dbColumnName ?? $this->name;
	}

	public function setDbColumnName(string $columnName)
	{
		$this->dbColumnName = $columnName;
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

	public function getDefault()
	{
		return $this->default;
	}

	public function default(string $default)
	{
		$this->default = $default;
		$this->addDbAttribute('default', [$this->getDefault()]);
		return $this;
	}

	protected function getNameDbAttribute()
	{
		$colType = $this->getDbColumnType();
		$attrVal = [$this->getDbColumnName()];
		
		if (is_array($colType)) {
			$args = $colType;
			$colType = $args[0];
			unset($args[0]);
			$attrVal = array_merge($attrVal, $args);
		}
		return [$colType => $attrVal];	
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
		return array_merge(
			$this->getNameDbAttribute(),
			$this->dbAttributes
		);
	}

	public function hasRelationship()
	{
		return $this->hasRelationship;	
	}

	protected function setRelationship(Relationship $relationship)
	{
		$relationship->setField($this);
		$this->relationship = $relationship;
		$this->hasRelationship = true;
		$this->dbColumnName = $relationship->columnName;
	}

	public function getRelationship()
	{
		return $this->relationship;
	}

	public function browseDisplay($dataItem)
	{
		return e($dataItem->{$this->getName()});
	}

	public function getValue($dataItem)
	{
		return $dataItem->{$this->name};
	}

}