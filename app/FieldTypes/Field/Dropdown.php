<?php

namespace App\FieldTypes\Field;

use App\FieldTypes\FieldType;
use App\FieldTypes\Relationship\BelongsTo;

/**
 * 
 */
class DropDown extends FieldType
{

	protected $listOptions = null;
	protected $optionsType;

	public function options($options)
	{		
		if (is_array($options)) {
			$this->optionsType = 'list';
			$this->addListOptions($options);
		} elseif ($options instanceof BelongsTo) {
			$this->optionsType = 'belongsTo';
			$this->setRelationship($options);
		} 
		return $this; 
	}

	protected function addListOptions(array $options)
	{		
		foreach ($options as $key => $value) {
			$this->listOptions[$key] = (object)[
				'displayName' => $value
			];
		}
	}
	

	public function getOptions($relationshipData = null)
	{
		if ($this->optionsType == 'list')
			return $this->listOptions;
	
		if ($this->optionsType == 'belongsTo' && !is_null($relationshipData)) 
			return $relationshipData[$this->getName()];		

		return [];
	}

	public function getDbColumnType()
	{
		if ($this->optionsType == 'belongsTo')
			return 'unsignedBigInteger';
		
		return 'string';		
	}

	public function getDbColumnName()
	{
		return $this->name."_id";
	}

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
		return 'dropdown';
	}

	public function browseDisplay($dataItem)
	{
		return e($dataItem->{$this->getName()}->displayName ?? '');
	}

	public function getValue($dataItem)
	{
		if ($this->optionsType == 'belongsTo') {
			// FIXME: add localkey to relationship or use laravel relationships throughout
			$localkey = $dataItem->{$this->name}()->getOwnerKeyName();
			return $dataItem->{$this->name}->{$localkey} ?? null;
		}	else
			return parent::getValue($dataItem);	
	}
}
