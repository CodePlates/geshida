<?php 

namespace App;

use App\CrudModel;

class CrudAction {

	protected $model;
	protected $fields; 
	protected $extraData = [];

	public function setModel($model)
	{
		$this->model = $model;
	}

	public function find($key)
	{
		return $this->model::findOrFail($key);
	}

	public function appendData(array $data)
	{
		$this->extraData = array_merge($this->extraData, $data);
	}

	public function getData()
	{
		return array_merge([            
         'model'     => $this->getModel(),             
         'datatype'  => $this->datatype(),
         'fields'    => $this->getFields(),
     	], $this->extraData);
	}	

	public function getModel()
	{
		return $this->model;
	}

	public function delete($id)
	{
		$this->model::destroy($id);
	}

	public function datatype()
	{
		return $this->model::getDatatype();
	}

	public function setFields(array $fields)
	{
		$fieldsArr = [];
		foreach ($fields as $field) {
			if ($field instanceof FieldType)
				$fieldsArr[$field->name] = $field;
			elseif (is_string($field))
				$fieldsArr[$field] = $this->datatype()->getFields($field);
		}
		$this->fields = collect($fieldsArr);		
	}

	public function getFields()
	{
		if (isset($this->fields)) 
			return $this->fields;
		return $this->datatype()->getFields(); 
	}

	protected function getRelationships()
	{		
		return $this->getFields()->filter(function($field){
			return $field->hasRelationship();
		})->mapWithKeys(function($field, $key){
			return [$key => $field->getRelationship()];
		});	
	}

	public function populateBrowseRelationshipData()
	{

	}

	public function populateFormRelationshipData()
	{
		$data = [];	
		foreach ($this->getRelationships() as $key => $relationship) {
			$data[$relationship->getName()] = $relationship->loadFormData();
		}
				
		$this->appendData(["relationshipData" => $data]);
	}


}