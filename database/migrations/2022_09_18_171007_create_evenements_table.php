<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->date('date');
            $table->time('heure');
            $table->string('duree');
            $table->string('region');
            $table->string('city');
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("author_id");
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign("author_id")->references("id")->on("users");
            $table->string('adresse');
            $table->string('lieu');
            $table->string('players_number');
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
        Schema::dropIfExists('evenements');
    }
};
