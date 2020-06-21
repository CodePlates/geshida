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
		// if ($this->optionsType == 'list')
		// 	return $this->listOptions;
		
		if (!is_null($relationshipData))
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
		$relationship = $this->getRelationship();
		$model->{$this->getName()}()->sync($value);		
	}

	public function getFormField()
	{
		return 'tags';
	}

	public function browseDisplay($dataItem)
	{
		$tags = $dataItem->{$this->getName()};
		$tagStr = $tags->map(function($tag){
			return $tag->displayName;
		})->join(', ');
		return e($tagStr);
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
