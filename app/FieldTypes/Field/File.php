<?php 

namespace App\FieldTypes\Field;

use App\FieldTypes\FileFieldType;
use Illuminate\Support\Facades\Hash;


class File extends FileFieldType
{
	public function getDbColumnType()
	{
		return 'string';
	}

	public function getFormField()
	{
		return 'file';
	}
	
}
