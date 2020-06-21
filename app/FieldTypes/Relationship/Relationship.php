<?php 

namespace App\FieldTypes\Relationship;

abstract class Relationship 
{
	protected $name;
	private $relationshipArgs = [];
	// protected $relatedModel;
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

	public function getRelatedModel()
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

	public function setModel($model)
	{
		$this->model = $model;
	}

	public function getModel()
	{
		return $this->model;
	}

	abstract function loadBrowseData($collection);

	abstract function loadFormData();

}