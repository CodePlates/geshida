<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class ModelScaffoldCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:model {datatype : The datatype class name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create model class from datatype';

    protected $type = 'Model';
    protected $datatype;
   
   
    /**
     * Execute the console command.
     *
     * @return mixed
     */    

    protected function getNameInput()
    {
        return trim($this->argument('datatype'));
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/model.stub';
    }

    protected function getArguments()
    {
        return [
            ['datatype', InputArgument::REQUIRED, 'The datatype class name'],
        ];
    }

    protected function buildClass($name)
    {
        $datatype = $this->getNameInput();
        $stub = parent::buildClass($name);
        $stub = str_replace("DummyDatatype", $datatype, $stub);
        return $stub;
    }
}
