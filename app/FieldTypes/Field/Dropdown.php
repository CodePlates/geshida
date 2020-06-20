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
			$this->listOptions = $options;
		} elseif ($options instanceof BelongsTo) {
			$this->optionsType = 'belongsTo';
			$this->setRelationship($options);
		}
		return $this; 
	}

	public function getOptions()
	{
		if ($this->optionsType == 'list')
			return $this->listOptions;

		return [];
	}

  public function getDbColumnType()
  {
    return 'string';
  }

  public function getFormField()
  {
    return 'dropdown';
  }
}
