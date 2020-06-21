<?php

namespace App\FieldTypes\Relationship;

use App\DataTypes\DataType;
use App\DatatypeMigrationCreator;
use Illuminate\Support\Str;

class BelongsToMany extends Relationship
{

	protected $tableName;
	protected $datatype;
	protected $foreignPivotKey;
	protected $localPivotKey;

	public function __construct($datatype, $model, $tableName, $foreignPivotKey = null, $localPivotKey = null)
	{
		$this->model = $model;
		$this->tableName = $tableName;
		$this->foreignPivotKey = $foreignPivotKey;
		$this->localPivotKey = $localPivotKey;
		$this->datatype = $datatype;

		$this->setRelationshipArgs([$tableName, $foreignPivotKey, $localPivotKey]);		
	}

	public function getRelationshipTypeName()
	{
		return 'belongsToMany';
	}
	
	public function loadFormData()
	{
		return $this->model::all();
	}

	public function loadBrowseData($collection)
	{
		$collection->load($this->getName());
		return $collection;
	}	

	protected function guessLoclaKey()
	{
		return Str::snake(class_basename($this->datatype)).'_id';
	}

	public function buildForeignKeyMigrations(DatatypeMigrationCreator $creator)
	{
		
	}

	public function buildMigrationColumn(DatatypeMigrationCreator $creator)
	{
		
	}

	public function buildExtraMigrations(DatatypeMigrationCreator $creator)
	{
		$foreignModel = new $this->model;

		$creator->createPivotTableMigration(
			$this->tableName,
			$this->localPivotKey ?? $this->guessLoclaKey(),
			$this->foreignPivotKey ?? $foreignModel->getForeignKey(),
			$this->datatype->getTableName(),
			$foreignModel->getTable()
		);
	}
}
