<?php

namespace App\Console\Commands;

use App\DatatypeMigrationCreator;
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
	protected $signature = 'scaffold:migration 
		{datatype : The datatype class name} 
		{--subsystem= : The subsystem to create the migration in}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create database migration from datatype';

		/**
	 * The migration creator instance.
	 *
	 * @var App\DatatypeMigrationCreator
	 */
		protected $creator;

		protected $files;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(DatatypeMigrationCreator $creator, Filesystem $files)
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
		$path = $this->getPath();	
					
		$file = $this->creator->createFromDatatype($path, $dataType);		
		$this->showFileCreatedMessage($file);		

		sleep(1);
		$files = $this->creator->runExtraMigrations($path, $dataType);
		foreach ($files as $file) {
			$this->showFileCreatedMessage($file);	
		}
		// $this->runExtraMigrations($dataType);


	}

	protected function showFileCreatedMessage($file)
	{
		$fileName = pathinfo($file, PATHINFO_FILENAME);
		$this->line("<info>Created Migration:</info> {$fileName}");
	}

	protected function getSubsystem()
   {
        $subsystem = trim($this->option('subsystem'));
        if (!empty($subsystem)) return $subsystem;

        $this->error("Subsystem not specified");
        exit();         
   }
	

	protected function qualifyDataTypeClass($name)
	{
		$subsystem = $this->getSubsystem();
		return "Subsystem\\$subsystem\\DataTypes\\".$name;
	}

	protected function resolve($class_name)
	{
		if (class_exists($class_name))
			return new $class_name;
		else
			throw new \Exception("Unable to find class ".$class_name);
	}

	protected function getPath()
   { 
		$subsystem = $this->getSubsystem();
		return base_path("cms/subsystems/$subsystem/database/migrations");
   }


	protected function getArguments()
	{
		return [
			['datatype', InputArgument::REQUIRED, 'The datatype class name'],
		];
	}
}
