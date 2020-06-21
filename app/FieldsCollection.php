<?php 

namespace App;

use App\FieldTypes\FileFieldType;
use Illuminate\Support\Collection;
/**
 * 
 */
class FieldsCollection extends Collection
{
	
	public function __construct($fields = [])
	{
		$items = [];
		foreach ($fields as $field) {
			$items[$field->name] = $field;
		}
		parent::__construct($items);		
	}

	public function hasFileFields()
	{
		return $this->contains(function ($value, $key) {
			return ($value instanceof FileFieldType);
		});
	}

	public function getFileFields()
	{
		return $this->whereInstanceOf(FileFieldType::class);
	}
}