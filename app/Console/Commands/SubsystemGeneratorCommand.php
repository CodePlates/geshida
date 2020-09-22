<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

abstract class SubsystemGeneratorCommand extends GeneratorCommand
{ 

    protected function getDatatypeInput()
    {
        return trim($this->argument('datatype'));
    }

    protected function getSubsystem()
    {
        $subsystem = trim($this->option('subsystem'));
        if (!empty($subsystem)) return $subsystem;

        $this->error("Subsystem not specified");
        exit();         
    }

    protected function qualifyDataTypeClass($name)
    {        
        return $this->rootNamespace()."DataTypes\\$name";
    }

    protected function resolve($class_name)
    {
        if (class_exists($class_name))
            return new $class_name;
        else
            throw new \Exception("Unable to find class ".$class_name);
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    { 
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        $name = str_replace('\\', '/', $name);
        $subsystem = $this->getSubsystem();

        return base_path("cms/subsystems/$subsystem/{$name}.php");
    }

    protected function rootNamespace()
    {
        $subsystem = $this->getSubsystem();
        return "Subsystem\\$subsystem\\";
    }
}
