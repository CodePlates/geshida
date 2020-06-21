<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScaffoldCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:common {datatype : The datatype class name} {--force}';

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
        $fullArgs = [
            'datatype' => $datatype,
            '--force' => $this->option('force'),
        ];

        $this->call('scaffold:migration', compact('datatype'));
        $this->call('scaffold:model', $fullArgs);
        $this->call('scaffold:controller', $fullArgs);
        $this->call('scaffold:lang', $fullArgs);
    }
}
