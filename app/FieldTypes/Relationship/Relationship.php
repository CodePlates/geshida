<?php 

namespace App\FieldTypes\Relationship;

use App\FieldTypes\FieldType;
use App\DatatypeMigrationCreator;

abstract class Relationship 
{
	protected $name;
	private $relationshipArgs = [];
	// protected $relatedModel;
	protected $model;
	protected $table;	
	protected $field;

	abstract function getRelationshipTypeName();

	abstract function buildForeignKeyMigrations(DatatypeMigrationCreator $creator);
	abstract function buildMigrationColumn(DatatypeMigrationCreator $creator);
	abstract function buildExtraMigrations(DatatypeMigrationCreator $creator, $datatype);

	public function getTable() 
	{
		return $this->table;
	}

	public function setField(FieldType $field)
	{
		$this->field = $field;
	}

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