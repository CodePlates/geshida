<?php

namespace App;

use Illuminate\Database\Migrations\Migrator as BaseMigrator;

class SubsystemMigrator extends BaseMigrator
{

    public $subsystem = null;

    

    protected function runUp($file, $batch, $pretend)
    {
        $this->repository->subsystem = $this->subsystem;
        parent::runUp($file, $batch, $pretend);
        $this->repository->subsystem = null;        
    }

   
    protected function runDown($file, $migration, $pretend)
    {
        $this->repository->subsystem = $this->subsystem;
        parent::runDown($file, $migration, $pretend);
        $this->repository->subsystem = null;          
    }

   
}
