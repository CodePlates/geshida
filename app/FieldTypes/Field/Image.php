<?php 

namespace App\FieldTypes\Field;

use App\FieldTypes\FileFieldType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Image extends FileFieldType
{
	public function getDbColumnType()
	{
		return 'string';
	}

	public function getFormField()
	{
		return 'image';
	}

	public function browseDisplay($dataItem)
	{
		$imageUrl = asset(Storage::url($dataItem->{$this->getName()}));
		return '<img src="'.e($imageUrl).'" width="40" height="40" />';
	}
	
}
