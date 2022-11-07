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
        Schema::create('reponses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('content');
            $table->unsignedBigInteger("author_id");
            $table->foreign("author_id")->references("id")->on("users");
            $table->unsignedBigInteger("aideAdmin_id");
            $table->foreign("aideAdmin_id")->references("id")->on("aide_admins");
            $table->enum("status", ["lu", "non-lu"])->default("non-lu");
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
        Schema::dropIfExists('reponses');
    }
};
