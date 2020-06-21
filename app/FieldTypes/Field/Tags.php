<?php

namespace App\FieldTypes\Field;

use App\FieldTypes\FieldType;
use App\FieldTypes\Relationship\BelongsTo;

/**
 * 
 */
class Tags extends FieldType
{

	public function options($options)
	{			
		$this->setRelationship($options);		
		return $this; 
	}	
	

	public function getOptions($relationshipData = null)
	{
		if ($this->optionsType == 'list')
			return $this->listOptions;
		
		if ($this->optionsType == 'belongsTo' && !is_null($relationshipData))
			return $relationshipData[$this->getName()]->keyBy('id');

		return [];
	}

	public function getDbColumnType()
	{
			return 'unsignedBigInteger';		
	}

	// public function getDbColumnName()
	// {
	// 	return null;
	// }

	public function saveAction($model, $value)
	{
		if ($this->optionsType == 'belongsTo') {
			$relationship = $this->getRelationship();
			$valueObj = $relationship->getRelatedModel()::find($value);
			$model->{$this->getName()}()->associate($valueObj);
		} else {
			$model->{$this->getName()} = $value;
		}
	}

	public function getFormField()
	{
		return 'tags';
	}

	public function browseDisplay($dataItem)
	{
		return e($dataItem->{$this->getName()}->displayName ?? '');
	}

	public function getValue($dataItem)
	{
		// if ($this->optionsType == 'belongsTo') {
		// 	// FIXME: add localkey to relationship or use laravel relationships throughout
		// 	$localkey = $dataItem->{$this->name}()->getOwnerKeyName();
		// 	return $dataItem->{$this->name}->{$localkey} ?? null;
		// }	else
		// 	return parent::getValue($dataItem);	
	}
}
