<?php

namespace App\FieldTypes\Relationship;

use App\DataTypes\DataType;
use App\DatatypeMigrationCreator;

class BelongsTo extends Relationship
{

	protected $foreignKey;
	protected $localKey;

	public function __construct($model, $foreignKey = null, $localKey = null)
	{
		if (!class_exists($model))
			throw new \Exception("Model: $model does not exist");
		$this->model = $model;
		$this->foreignKey = $foreignKey;
		$this->localKey = $localKey;

		$this->setRelationshipArgs([$foreignKey, $localKey]);		
	}

	public function getRelationshipTypeName()
	{
		return 'belongsTo';
	}	

	public function loadFormData()
	{
		return $this->model::all()->getDictionary();
	}

	public function loadBrowseData($collection)
	{
		$collection->load($this->field->getName());
		return $collection;
	}

	protected function resolveModel()
	{
		return new $this->model;
	}

	public function buildForeignKeyMigrations(DatatypeMigrationCreator $creator)
	{
		return $creator->createForeignKeyString(
			$this->field->getDbColumnName(), 
			$this->resolveModel()->getTable()
		);
	}

	public function buildMigrationColumn(DatatypeMigrationCreator $creator)
	{
		return $creator->createFieldLine($this->field);
	}

	public function buildExtraMigrations(DatatypeMigrationCreator $creator, $datatype)
	{

	}


}
