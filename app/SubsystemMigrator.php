<?php

namespace App;

use Illuminate\Database\Migrations\Migrator as BaseMigrator;

class SubsystemMigrator extends BaseMigrator
{

    public function setSubsystem($subsystem)
    {
        $this->repository->subsystem = $subsystem;
    }    

    public function resetSubsystem()
    {
        $this->repository->subsystem = null;
    }

   
}
