<?php

namespace App\FieldTypes\Relationship;

use App\DataTypes\DataType;

class BelongsTo extends Relationship
{

	protected $foreignKey;
	protected $datatype;
	protected $localKey;

	public function __construct(DataType $datatype, $name, $model, $foreignKey = null, $localKey = null)
	{
		$this->datatype = $datatype;
		$this->name = $name;
		$this->model = $model;
		$this->foreignKey = $foreignKey;
		$this->localKey = $localKey;

		$this->setRelationshipArgs([$foreignKey, $localKey]);		
	}

	public function getRelationshipTypeName()
	{
		return 'belongsTo';
	}

	public function getTable()
	{
		return $this->datatype->getTableName();
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
}
