<?php 

namespace App\FieldTypes\Relationship;

abstract class Relationship 
{
	private $relationshipArgs;

	protected $name;

	protected $model;

	protected $table;

	abstract function getRelationshipTypeName();

	abstract function getTable();

	public function getRelationshipArgs()
	{
		return $this->relationshipArgs;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getModel()
	{
		return $this->model;
	}

	protected function setRelationshipArgs(array $args)
	{
		foreach ($args as $arg) {
			if (!is_null($arg))
				$relationshipArgs[] = $arg;
		}
	}

}