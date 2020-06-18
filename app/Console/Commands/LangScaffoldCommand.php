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
    protected $signature = 'scaffold:lang {datatype : The datatype class name}';

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
        $dataKey = $dataType->getName();
        $path = resource_path("lang/en/{$dataKey}.php");

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
        $this->files->put($path, $content);

        $fileName = basename($path);
        $this->line("<info>Lang file created:</info> {$fileName}");
    }

    protected function generateFieldLabels($dataType)
    {
        $fieldLabels = "";
        foreach ($dataType->getFieldNames() as $fieldName) {
            $label = Str::title(str_replace('_', ' ', $fieldName));
            $fieldLabels .= "'$fieldName' => '$label',\n\t";
        }
        return $fieldLabels;
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/lang.stub';
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
}
