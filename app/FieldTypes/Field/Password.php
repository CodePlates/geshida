<?php 

namespace App\FieldTypes\Field;

use App\FieldTypes\FieldType;
use Illuminate\Support\Facades\Hash;


class Password extends FieldType
{
	public function getDbColumnType()
	{
		return 'string';
	}

	public function getFormField()
	{
		return 'password';
	}

	public function saveAction($model, $value)
	{
		$model->{$this->getName()} = Hash::make($value);
	}
}
