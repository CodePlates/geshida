<?php

namespace App\FieldTypes\Relationship;

use App\DataTypes\DataType;
use App\DatatypeMigrationCreator;
use Illuminate\Support\Str;

class BelongsToMany extends Relationship
{

	protected $tableName;
	protected $foreignPivotKey;
	protected $localPivotKey;

	public function __construct($model, $tableName, $foreignPivotKey = null, $localPivotKey = null)
	{
		$this->model = $model;
		$this->tableName = $tableName;
		$this->foreignPivotKey = $foreignPivotKey;
		$this->localPivotKey = $localPivotKey;

		$this->setRelationshipArgs([$tableName, $foreignPivotKey, $localPivotKey]);		
	}

	public function getRelationshipTypeName()
	{
		return 'belongsToMany';
	}
	
	public function loadFormData()
	{
		return $this->model::all()->getDictionary();
	}

	public function loadBrowseData($collection)
	{
		$collection->load($this->getName());
		return $collection;
	}
	
	public function buildForeignKeyMigrations(DatatypeMigrationCreator $creator)
	{
		
	}

	public function buildMigrationColumn(DatatypeMigrationCreator $creator)
	{
		
	}

	public function buildExtraMigrations(DatatypeMigrationCreator $creator, $datatype)
	{
		$foreignModel = new $this->model;		

		return [$creator->createPivotTableMigration(
			$this->tableName,
			$this->localPivotKey ?? Str::snake(class_basename($datatype)).'_id',
			$this->foreignPivotKey ?? $foreignModel->getForeignKey(),
			$datatype->getTableName(),
			$foreignModel->getTable()
		)];
	}
}
