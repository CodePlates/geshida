<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class LangScaffoldCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:lang 
        {datatype : The datatype class name} 
        {--subsystem= : The subsystem to create the lang file in}
        {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create lang file from datatype';

    protected $files;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $datatypeName = trim($this->argument('datatype'));
        $dataTypeClass = $this->qualifyDataTypeClass($datatypeName);
        $dataType = $this->resolve($dataTypeClass);
        
        $path = $this->getPath($dataType->getLangKey());

        $content = $this->files->get($this->getStub());

        $replacements = [
            'DummyName' => $datatypeName,
            'DummyPluralName' => Str::plural($datatypeName),
            'DummyFields' => $this->generateFieldLabels($dataType),
        ];

        $content = str_replace(
            array_keys($replacements), 
            array_values($replacements), 
            $content
        );    

        $this->makeDirectory($path);
        $this->files->put($path, $content);

        $fileName = basename($path);
        $this->line("<info>Lang file created:</info> {$fileName}");
    }

    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }

    protected function generateFieldLabels($dataType)
    {
        $fieldLabels = "";
        foreach ($dataType->getAllFields()->getNames() as $fieldName) {
            $label = Str::title(str_replace('_', ' ', $fieldName));
            $fieldLabels .= "'$fieldName' => '$label',\n\t";
        }
        return $fieldLabels;
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/lang.stub';
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

    protected function rootNamespace()
    {
        $subsystem = $this->getSubsystem();
        return "Subsystem\\$subsystem\\";
    }

    protected function getPath($langKey)
    { 
        $subsystem = $this->getSubsystem();

        return base_path("cms/subsystems/$subsystem/lang/en/{$langKey}.php");
    }

    protected function resolve($class_name)
    {
        if (class_exists($class_name))
            return new $class_name;
        else
            throw new \Exception("Unable to find class ".$class_name);
    }
}
