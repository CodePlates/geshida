<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class ScaffoldCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:common 
        {datatype : The datatype class name} 
        {--subsystem= : The subsystem to create the scaffold resources in}
        {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold common subsystem resources from datatype';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $datatype = trim($this->argument('datatype'));
        $subsystem = trim($this->option('subsystem'));

        $fullArgs = [
            'datatype' => $datatype,
            '--subsystem' => $subsystem,
            '--force' => $this->option('force'),
        ];

        $this->call('scaffold:migration', Arr::except($fullArgs, ['--force']));
        $this->call('scaffold:model', $fullArgs);
        $this->call('scaffold:controller', $fullArgs);
        $this->call('scaffold:lang', $fullArgs);
    }
}
