<?php

namespace App;

use Illuminate\Database\Migrations\DatabaseMigrationRepository;
use Illuminate\Database\ConnectionResolverInterface as Resolver;

/**
 * i had no choice
 */
class SubsystemMigrationRepository extends DatabaseMigrationRepository
{
   
    public $subsystem; 
    /**
     * Get the completed migrations.
     *
     * @return array
     */
    public function getRan()
    {
        return $this->table()
                ->orderBy('batch', 'asc')
                ->orderBy('migration', 'asc')
                ->where('subsystem', $this->subsystem)
                ->pluck('migration')->all();
    }
   

    /**
     * Get list of migrations.
     *
     * @param  int  $steps
     * @return array
     */
    public function getMigrations($steps)
    {
        $query = $this->table()->where('batch', '>=', '1');

        return $query->orderBy('batch', 'desc')
                     ->orderBy('migration', 'desc')
                     ->where('subsystem', $this->subsystem)
                     ->take($steps)->get()->all();
    }

    /**
     * Get the last migration batch.
     *
     * @return array
     */
    public function getLast()
    {
        $query = $this->table()->where('subsystem', $this->subsystem)->where('batch', $this->getLastBatchNumber());

        return $query->orderBy('migration', 'desc')->get()->all();
    }

    /**
     * Get the completed migrations with their batch numbers.
     *
     * @return array
     */
    public function getMigrationBatches()
    {
        return $this->table()
                ->orderBy('batch', 'asc')
                ->orderBy('migration', 'asc')
                ->where('subsystem', $this->subsystem)
                ->pluck('batch', 'migration')->all();
    }

    /**
     * Log that a migration was run.
     *
     * @param  string  $file
     * @param  int  $batch
     * @return void
     */
    public function log($file, $batch)
    {
        $record = [
            'migration' => $file, 
            'batch' => $batch, 
            'subsystem' => $this->subsystem
        ];

        $this->table()->insert($record);
    }

    /**
     * Remove a migration from the log.
     *
     * @param  object  $migration
     * @return void
     */
    public function delete($migration)
    {
        $this->table()->where('subsystem', $this->subsystem)->where('migration', $migration->migration)->delete();
    }

    /**
     * Get the next migration batch number.
     *
     * @return int
     */
    public function getNextBatchNumber()
    {
        return $this->getLastBatchNumber() + 1;
    }

    /**
     * Get the last migration batch number.
     *
     * @return int
     */
    public function getLastBatchNumber()
    {
        return $this->table()->where('subsystem', $this->subsystem)->max('batch');
    }

    /**
     * Create the migration repository data store.
     *
     * @return void
     */
    public function createRepository()
    {
        $schema = $this->getConnection()->getSchemaBuilder();

        $schema->create('subsystems', function ($table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('display_name');
            $table->boolean('installed')->default(false);
            $table->boolean('enabled')->default(false);
            $table->string('theme')->default('default');
            $table->string('route')->nullable();
            $table->timestamps();
        });

        $schema->create($this->table, function ($table) {           
            $table->increments('id');
            $table->string('migration');
            $table->string('subsystem')->nullable();
            $table->integer('batch');
        });
    }
   

}
