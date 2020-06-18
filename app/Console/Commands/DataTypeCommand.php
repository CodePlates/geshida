<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use App\DataTypes\DataType;

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

    protected function getStub()
    {
        return __DIR__.'/stubs/datatype.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return 'App\DataTypes';
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the datatype'],
        ];
    }
    
}
