<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class PolicyScaffoldCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:policy 
    {datatype : The datatype class name} 
    {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a policy class from datatype';

    protected $type = 'Policy';

    protected function getStub()
    {
        return __DIR__.'/stubs/policy.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Policies';
    }

    protected function buildClass($name)
    {
        //FIXME: take time, rewrite this instead of copy paste like you did. 
        // FIXME: conflict with user policy multiple use App\User
        $datatypeName = $this->getDatatypeInput();
        $dataTypeClass = $this->qualifyDataTypeClass($datatypeName);
        $dataType = $this->resolve($dataTypeClass);

        $stub = parent::buildClass($name);
        
        $namespaceModel = $this->laravel->getNamespace().$datatypeName;
        $model = class_basename(trim($datatypeName, '\\'));

        if (Str::startsWith($model, '\\')) {
            $stub = str_replace('NamespacedDummyModel', trim($model, '\\'), $stub);
        } else {
            $stub = str_replace('NamespacedDummyModel', $namespaceModel, $stub);
        }


        $dummyUser = class_basename($this->userProviderModel());

        $dummyModel = Str::camel($model) === 'user' ? 'model' : $model;

        $stub = str_replace('DocDummyModel', Str::snake($dummyModel, ' '), $stub);

        $stub = str_replace('DummyModel', $model, $stub);

        $stub = str_replace('dummyModel', Str::camel($dummyModel), $stub);

        $stub = str_replace('DummyUser', $dummyUser, $stub);

        $stub = str_replace('DocDummyPluralModel', Str::snake(Str::pluralStudly($dummyModel), ' '), $stub);

        

        return str_replace('DummySlug', $dataType->getSlug(), $stub);
    }

    protected function getNameInput()
    {
        return $this->getDatatypeInput().'Policy';
    }

    protected function getDatatypeInput()
    {
        return trim($this->argument('datatype'));
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

    protected function getOptions()
    {
        return [];
    }
}
