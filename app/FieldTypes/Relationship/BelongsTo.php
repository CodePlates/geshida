<?php 

namespace App\FieldTypes\Relationship;

class BelongsTo extends Relationship
{
	
	protected $foreignKey;

	protected $localKey; 

	public function __construct($name, $model, $foreignKey = null, $localKey = null)
	{
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
}