<?php

namespace App;

use App\DataTypes\DataType;
use App\FieldTypes\FieldType;
use App\FieldTypes\Relationship\BelongsTo;
use Illuminate\Database\Migrations\MigrationCreator;


class DatatypeMigrationCreator extends MigrationCreator
{
	protected $datatype;

	protected $tab = '    ';

	public function createFromDatatype(DataType $datatype)
	{  
		$this->datatype = $datatype;  
		$table = $datatype->getTableName(); 
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
		$fieldLines = "";
		foreach ($this->datatype->getAllFields() as $field) {  
			if ($field->hasRelationship()) 
				$fieldLines .= $field->getRelationship()->buildMigrationColumn($this);
			else      
				$fieldLines .= $this->createFieldLine($field);
		}
		return str_replace('DummyFields', $fieldLines, $stub);
	}

	public function createFieldLine(FieldType $field)
	{		
		$fieldLine = "\$table";
		$fieldLine .= $this->buildAttributes($field);
		$fieldLine .= ";\n".str_repeat($this->tab, 3);
		return $fieldLine;
	}

	public function createForeignKeyString($column, $table, $onUpdate = 'cascade', $onDelete = 'cascade')
	{		
		$str = "\n\n".str_repeat($this->tab, 3);
		$str .= "\$table->foreign('%s')->references('id')->on('%s')\n";
      $str .= str_repeat($this->tab, 4)."->onUpdate('%s')\n";
      $str .= str_repeat($this->tab, 4)."->onDelete('%s');";
      return sprintf($str, $column, $table, $onUpdate, $onDelete);
	}

	protected function addRelationships($stub)
	{
		$relationshipLines = '';
		foreach ($this->datatype->getAllFields() as $field) {  
			if ($field->hasRelationship()) {
				$relationshipLines .= $field
					->getRelationship()
					->buildForeignKeyMigrations($this);
			}
		}
		return str_replace("DummyRelationships", $relationshipLines, $stub);
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