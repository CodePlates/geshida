<?php

namespace App;

use App\DataTypes\DataType;
use App\FieldTypes\FieldType;
use Illuminate\Filesystem\Filesystem;
use App\FieldTypes\Relationship\BelongsTo;
use Illuminate\Database\Migrations\MigrationCreator;


class DatatypeMigrationCreator 
{
	protected $tab = '    ';

	protected $isPivot;

	protected $creator;

	protected $files;

	public function __construct(Filesystem $files, MigrationCreator $creator)
	{
		$this->creator = $creator;
		$this->files = $files;
	}

	protected function createStubFromFile($file)
	{
		$contents = $this->files->get($file);
		return str_replace(
			'$table->timestamps();', 
			'DummyFields DummyRelationships', 
			$contents
		);

	}

	public function createFromDatatype(DataType $datatype)
	{  
		$this->isPivot = false;  
		$table = $datatype->getTableName().rand(1,1000); 
		$file = $this->creator->create(
			"create_{$table}_table", 
			$this->getMigrationPath(), 
			$table, 
			true
		);

		$fields = $datatype->getAllFields();		

		$stub = $this->createStubFromFile($file);
		$stub = $this->addFields($fields, $stub);
		$stub = $this->addRelationships($fields->getRelationships(), $stub);

		$this->files->put($file, $stub);
		return $file;
	}

	public function createPivotTableMigration($table)
	{
		$this->isPivot = true;

		$file = parent::create(
			"create_{$table}_table", 
			$this->getMigrationPath(), 
			$table, 
			true
		);
	}



	public function runExtraMigrations($datatype)
	{
		// NB: has to run last coz may overwrite datatype
		// suggested fix is to inject migration creator
		// and simply use it. unsure if i can overwrite getStub though
		// will check in the future 
		foreach ($datatype->getAllFields() as $field) {  
			if ($field->hasRelationship()) {
				$field->getRelationship()->buildExtraMigrations($this);
			}
		}
	}

	

	// protected function populateStub($stub, $table)
	// {
	// 	if (!$this->isPivot) {
	// 		$stub = $this->addFields($stub);
	// 		$stub = $this->addRelationships($stub);
	// 	}
	// 	return $stub;
	// }

	protected function getMigrationPath() 
	{
		return database_path('migrations');
	}

	protected function addFields($fields, $stub)
	{
		$fieldLines = "";
		foreach ($fields as $field) {  
			if ($field->hasRelationship()) 
				$fieldLines .= $field->getRelationship()->buildMigrationColumn($this);
			else      
				$fieldLines .= $this->createFieldLine($field);
		}	
		$fieldLines .= $this->createDbColumnLine(["timestamps" => null], true);	
		return str_replace('DummyFields', $fieldLines, $stub);
	}

	public function createFieldLine(FieldType $field)
	{		
		return $this->createDbColumnLine($field->getDbAttributes());
	}

	public function createDbColumnLine(array $dbAttributes, $last=false)
	{
		$fieldLine = "\$table";
		$fieldLine .= $this->buildAttributes($dbAttributes).";";
		if (!$last) 
			$fieldLine .= "\n".str_repeat($this->tab, 3);
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

	protected function addRelationships($relationships, $stub)
	{
		$relationshipLines = '';
		foreach ($relationships as $relationship) { 			
				$relationshipLines .= $relationship
					->buildForeignKeyMigrations($this);			
		}
		return str_replace("DummyRelationships", $relationshipLines, $stub);
	}

	protected function buildAttributes(array $dbAttributes)
	{
		$attributeStr = '';		
		foreach ($dbAttributes as $attribute => $values) {			
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