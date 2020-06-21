<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 50);
            $table->text('excerpt')->nullable();
            $table->unsignedBigInteger('human_id')->nullable();
            $table->unsignedBigInteger('luman_id')->nullable();
            $table->timestamps(); 

            $table->foreign('human_id')->references('id')->on('humans')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('luman_id')->references('id')->on('humans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
