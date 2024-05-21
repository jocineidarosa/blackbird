<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_tags', function (Blueprint $table) {
            $table->id();
            $table->string('tag1');
            $table->string('tag2');
            $table->string('tag3');
            $table->string('tag4');
            $table->string('tag5');
            $table->string('tag6');
            $table->string('tag7');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_tags');
    }
}
