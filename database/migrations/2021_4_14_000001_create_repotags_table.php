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
            $table->foreignId('tag_id')->constrained('tags'); // id do tag passado
            $table->string('message'); // message passado para tag
            $table->string('sharepo', 160); // sha do tag setado
            $table->string('url', 200); // url do tag passado
            $table->string('tagrepo', 60); // tag do repositorio
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
