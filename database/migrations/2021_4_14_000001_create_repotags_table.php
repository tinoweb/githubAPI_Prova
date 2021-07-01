<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepotagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repotags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('tag_id')->constrained('tags');
            $table->integer('idrepo');
            $table->integer('iddonorepo');
            $table->string('nomerepo', 100);
            $table->string('donorepo', 100);
            $table->string('tagrepo', 60);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repotags');
    }
}
