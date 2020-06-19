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
    protected $signature = 'scaffold:common {datatype : The datatype class name}';

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
        $this->call('scaffold:migration', ['datatype' => $datatype]);
        $this->call('scaffold:model', ['datatype' => $datatype]);
        $this->call('scaffold:controller', ['datatype' => $datatype]);
        $this->call('scaffold:lang', ['datatype' => $datatype]);
    }
}
