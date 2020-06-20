<?php

namespace App;

use App\DataTypes\DataType;
use App\FieldTypes\FieldType;
use Illuminate\Database\Migrations\MigrationCreator;

class DatatypeMigrationCreator extends MigrationCreator
{
	protected $datatype;

	public function createFromDatatype(DataType $datatype)
	{  
		$this->datatype = $datatype;  
		$table = $datatype->getTableName().rand(0,1000); 
		$file = parent::create(
			"create_{$table}_table", 
			$this->getMigrationPath(), 
			$table, 
			true
		);


		//foreach relationship
		// relationship->buildMigration()vc
		return $file;
	}

	protected function getStub($table, $create)
	{
		return  $this->files->get(app_path("Console/Commands/stubs/migration.stub"));
	}

	protected function populateStub($name, $stub, $table)
	{
		$stub = parent::populateStub($name, $stub, $table);
		$stub = $this->addFields($stub);
		$stub = $this->addRelationships($stub);
		return $stub;
	}

	protected function getMigrationPath() 
	{
		return database_path('migrations');
	}

	protected function addFields($stub)
	{
		$fieldString = "";
		foreach ($this->datatype->getFields() as $field) {           
			$fieldString .= "\$table";
			$fieldString .= $this->buildAttributes($field);
			$fieldString .= ";\n            ";
		}
		return str_replace('DummyFields', $fieldString, $stub);
	}

	protected function addRelationships($stub)
	{
		return str_replace("DummyRelationships",'',$stub);
	}

	protected function buildAttributes(FieldType $field)
	{
		$attributeStr = '';		
		foreach ($field->getDbAttributes() as $attribute => $values) {			
			$valueStr = "";
			if (!is_null($values))
				$valueStr = $this->implodeAttrValues($values);
			$attributeStr .= "->{$attribute}({$valueStr})";
		}
		return $attributeStr;
	}

	private function implodeAttrValues(array $attrValues)
	{
		$result = '';
		foreach ($attrValues as $key => $value) {
			if ($key != 0)
				$result .= ', ';
			$result .= str_replace('"', "'", json_encode($value));
		}
		return $result;
	}
}