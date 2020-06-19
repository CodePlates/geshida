<?php

namespace App\FieldTypes\Field;

use App\FieldTypes\FieldType;

/**
 * 
 */
class DropDown extends FieldType
{

	protected $listOptions = null;

	public function options($options)
	{
		$this->listOptions = $options;
		return $this; 
	}

	public function getOptions()
	{
		return $this->listOptions;
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
