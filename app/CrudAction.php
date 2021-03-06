<?php 

namespace App;

use App\CrudModel;
use App\FieldsCollection;
use App\FieldTypes\FieldType;

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
				$fieldsArr[] = $field;
			elseif (is_string($field)) {
				$fieldObj = $this->datatype()->getField($field);
				if ($fieldObj)
					$fieldsArr[] = $fieldObj;
			}
		}
		$this->fields = new FieldsCollection($fieldsArr);		
	}

	public function getFields()
	{
		if (isset($this->fields)) 
			return $this->fields;
		return $this->datatype()->getAllFields(); 
	}

	protected function getRelationships()
	{		
		$relationships = [];
		foreach ($this->getFields() as $key => $field) {
			if ($field->hasRelationship())
				$relationships[$key] = $field->getRelationship();
		}			
		return $relationships;
	}

	public function populateBrowseRelationshipData()
	{

	}

	public function populateFormRelationshipData()
	{
		$data = [];	
		foreach ($this->getRelationships() as $key => $relationship) {
			$data[$key] = $relationship->loadFormData();
		}
				
		$this->appendData(["relationshipData" => $data]);
	}


}