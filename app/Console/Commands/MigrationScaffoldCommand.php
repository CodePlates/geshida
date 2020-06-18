<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Database\Migrations\MigrationCreator;

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
            $fieldString .= "\$table->{$field->getDbColumnType()}('{$field->getName()}');\n            ";             
        }
        $content = $this->files->get($file);
        $position = strpos($content, '$table->timestamps()');                
        $content = substr_replace($content, $fieldString, $position, 0);

        $this->files->put($file, $content);

    }

    protected function getArguments()
    {
        return [
            ['datatype', InputArgument::REQUIRED, 'The datatype class name'],
        ];
    }
}
