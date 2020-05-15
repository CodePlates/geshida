<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Migrations\MigrationCreator;

class MigrationScaffoldCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:migration {datatype}';

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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MigrationCreator $creator)
    {
        parent::__construct();

        $this->creator = $creator;
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
            throw Exception("Unable to find class ".$class_name);
    }

    protected function getArguments()
    {
        return [
            ['datatype', InputArgument::REQUIRED, 'The datatype class name'],
        ];
    }
}
