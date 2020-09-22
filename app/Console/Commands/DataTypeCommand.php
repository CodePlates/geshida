<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;

class DataTypeCommand extends SubsystemGeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:datatype 
        {name : The name of the datatype} 
        {--subsystem= : The subsystem to create the datatype in}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new subsystem datatype';

    protected $type = 'DataType';

    protected function getNameInput()
    {
        return Str::studly(trim($this->argument('name')));
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/datatype.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\DataTypes';
    }    
    
}
