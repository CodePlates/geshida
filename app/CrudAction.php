<?php 

namespace App;

use App\CrudModel;

class CrudAction {

	protected $model;
	protected $fields; 

	public function setModel($model)
	{
		$this->model = $model;
	}

	public function getAll()
	{
		// TODO: make query more modifiable
		return $this->model::all();	
	}

	public function datatype()
	{
		return $this->model::getDatatype();
	}

	public function setFields(array $fields)
	{
		$this->fields = $fields;
	}

	public function getFields()
	{
		if (isset($this->fields)) return $this->fields;
		return $this->datatype()->getFieldNames(); 
	}


}