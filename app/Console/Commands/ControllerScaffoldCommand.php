<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ControllerScaffoldCommand extends SubsystemGeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:controller 
        {datatype : The datatype class name}
        {--subsystem= : The subsystem to create the controller in}
        {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create basic controller from datatype';

    protected $type = 'Controller';

    protected function getNameInput()
    {
        return $this->getDatatypeInput().'Controller';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\App\Http\Controllers';
    }
   
    protected function getStub()
    {
        return __DIR__.'/stubs/controller.stub';
    }

    protected function buildClass($name)
    {
        $modelClassName = $this->getDatatypeInput();
        $modelClass = "{$this->rootNamespace()}Models\\$modelClassName";

        if (! class_exists($modelClass)) {
            if ($this->confirm("A {$modelClass} model does not exist. Do you want to generate it?", true)) {
                $this->call('scaffold:model', [
                    'datatype' => $modelClassName,
                    '--subsystem' => $this->getSubsystem()
                ]);
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
