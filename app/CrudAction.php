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

	public function find($key)
	{
		return $this->model::findOrFail($key);
	}

	public function getAll()
	{
		// TODO: make query more modifiable
		return $this->model::all();	
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
		$this->fields = $fields;
	}

	public function getFields()
	{
		if (isset($this->fields)) return $this->fields;
		return $this->datatype()->getFieldNames(); 
	}


}