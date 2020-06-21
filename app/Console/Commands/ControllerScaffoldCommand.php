<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class ControllerScaffoldCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:controller 
        {datatype : The datatype class name}
        {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create crud controller from datatype';

    protected $type = 'Controller';

    protected function getNameInput()
    {
        return trim($this->argument('datatype')).'Controller';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return 'App\Http\Controllers';
    }
   
    protected function getStub()
    {
        return __DIR__.'/stubs/controller.stub';
    }

    protected function buildClass($name)
    {
        $modelClassName = trim($this->argument('datatype'));
        $modelClass = 'App\\'.$modelClassName;

        if (! class_exists($modelClass)) {
            if ($this->confirm("A {$modelClass} model does not exist. Do you want to generate it?", true)) {
                $this->call('scaffold:model', ['datatype' => $modelClassName]);
            }
        }

        $replacements = [
            'DummyFullModelClass' => $modelClass,
            'DummyModelClass' => $modelClassName,
            'DummyModelVariable' => lcfirst($modelClassName),
        ];

        return str_replace(
            array_keys($replacements), 
            array_values($replacements), 
            parent::buildClass($name)
        );
    }
}
