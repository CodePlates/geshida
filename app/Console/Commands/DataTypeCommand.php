<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use App\DataTypes\DataType;
use Illuminate\Support\Str;


class DataTypeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:datatype {name : The name of the datatype}';

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
        return 'App\DataTypes';
    }    
    
}
