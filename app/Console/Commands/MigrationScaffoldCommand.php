<?php

namespace App\Console\Commands;

use App\FieldTypes\FieldType;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Database\Migrations\MigrationCreator;
use Symfony\Component\Console\Input\InputArgument;

class MigrationScaffoldCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'scaffold:migration {datatype : The datatype class name}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create database migration from datatype';

		/**
	 * The migration creator instance.
	 *
	 * @var \Illuminate\Database\Migrations\MigrationCreator
	 */
		protected $creator;

		protected $files;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(MigrationCreator $creator, Filesystem $files)
	{
		parent::__construct();

		$this->creator = $creator;
		$this->files = $files;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{        
		$dataTypeClass = $this->qualifyDataTypeClass(
			trim($this->argument('datatype'))
		);
		$dataType = $this->resolve($dataTypeClass);
		$table = $dataType->getTableName(); 
		$file = $this->creator->create(
			"create_{$table}_table", 
			$this->getMigrationPath(), 
			$table, 
			true
		);

		$this->fillMigrationFile($file, $dataType);

		$fileName = pathinfo($file, PATHINFO_FILENAME);
		$this->line("<info>Created Migration:</info> {$fileName}");
	}

	protected function getMigrationPath() 
	{
		return $this->laravel->databasePath().DIRECTORY_SEPARATOR.'migrations';
	}

	protected function qualifyDataTypeClass($name)
	{
		return "App\\DataTypes\\".$name;
	}

	protected function resolve($class_name)
	{
		if (class_exists($class_name))
			return new $class_name;
		else
			throw new \Exception("Unable to find class ".$class_name);
	}

	protected function fillMigrationFile($file, $dataType)
	{
		$fieldString = "";
		foreach ($dataType->getFields() as $field) {           
			$fieldString .= "\$table";
			$fieldString .= $this->buildAttributes($field);
			$fieldString .= ";\n            ";
		}
		$content = $this->files->get($file);
		$position = strpos($content, '$table->timestamps()');                
		$content = substr_replace($content, $fieldString, $position, 0);

		$this->files->put($file, $content);
	}

	protected function buildAttributes(FieldType $field)
	{
		$attributeStr = '';		
		foreach ($field->getDbAttributes() as $attribute => $values) {			
			$valueStr = "";
			if (!is_null($values))
				$valueStr = $this->implodeAttrValues($values); //"'".implode("', '", $values)."'";			
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


	protected function getArguments()
	{
		return [
			['datatype', InputArgument::REQUIRED, 'The datatype class name'],
		];
	}
}
