<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_id');
            $table->string('title');
            $table->string('url');
            $table->boolean('new_tab')->default(false);
            $table->string('icon')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('order');
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menus')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('parent_id')->references('id')->on('menu_items')
                ->onUpdate('cascade')
                ->onDelete('set null');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}
