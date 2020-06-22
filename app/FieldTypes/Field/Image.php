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
		$path = $dataItem->{$this->getName()};
		if ($path) {
			$imageUrl = asset(Storage::url($path));
			return '<img src="'.e($imageUrl).'" width="40" height="40" />';
		}  
		return '';
	}
	
}
