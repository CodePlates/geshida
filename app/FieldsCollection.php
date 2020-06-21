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

	public function getNames()
	{
		$fields = collect($this->all());
		return $fields->keys();
	}

	public function getRelationships()
	{
		$fields = collect($this->all());
		return $fields->filter(function($field){
			return $field->hasRelationship();
		})->map(function($field, $key){
			return $field->getRelationship();
		});
	}

	public function keys()
	{
		return $this->getNames();
	}

}