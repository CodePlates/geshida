<?php

namespace App\Console\Commands;

use App\FieldTypes\Relationship\Relationship;
use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;

class ModelScaffoldCommand extends SubsystemGeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:model 
        {datatype : The datatype class name}  
        {--subsystem= : The subsystem to create the model in}  
        {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create model class from datatype';

    protected $type = 'Model';

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
        return __DIR__ . '/stubs/model.stub';
    }    

    protected function buildClass($name)
    {
        $datatypeName = $this->getNameInput();
        $stub = parent::buildClass($name);
        $stub = str_replace("DummyDatatype", $datatypeName, $stub);
        $stub = $this->addRelationships($stub, $datatypeName);
        return $stub;
    }

    protected function addRelationships($stub, $datatypeName)
    {
        $relationshipStr = '';
        $dataTypeClass = $this->qualifyDataTypeClass($datatypeName);
        $dataType = $this->resolve($dataTypeClass);
        $fields = $dataType->getAllFields();
        $fields = $fields->filter(function ($field) {
            return $field->hasRelationship();
        });

        if ($fields->isNotEmpty()) {
            foreach ($fields as $key => $field) {
                $relationship = $field->getRelationship();
                $content = "\n\tpublic function {$field->name}()\n";
                $content .= "\t{\n\t\treturn \$this->";
                $content .= sprintf("%s('%s'%s);\n\t}\n",
                    $relationship->getRelationshipTypeName(),
                    $relationship->getRelatedModel(),
                    $this->buildRelationshipArgs($relationship->getRelationshipArgs())
                );                

                $relationshipStr .= $content;
            }
        }

        $stub = $this->addDisplayName($stub, $dataType);
        return str_replace("DummyRelationship", $relationshipStr, $stub);
    }

    protected function addDisplayName($stub, $datatype)
    {      
        $content = '';  
        $displayField = $datatype->getDisplayNameField();
       
        if ($displayField == 'display_name') 
            $displayField = 'attributes[\'display_name\']';

        $content .= "\tpublic function getDisplayNameAttribute()\n";
        $content .= "\t{\n\t\treturn \$this->";
        $content .= $displayField.";\n\t}";        

        return str_replace("DummyDisplayName", $content, $stub);
    }

    private function buildRelationshipArgs(array $args = [])
    {
        $result = '';
        if (count($args) > 0) {
            $result .= ",'" . implode(', ', $args) . "'";
        }
        return $result;
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Models';
    }
}
