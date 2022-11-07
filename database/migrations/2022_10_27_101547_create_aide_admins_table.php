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
        Schema::create('aide_admins', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('email');
            $table->string('content');
            $table->unsignedBigInteger("author_id");
            $table->foreign("author_id")->references("id")->on("users");
            $table->enum("status", ["lu", "non-lu"])->default("non-lu");
            $table->enum("verified", ["V", "X"])->default("X");
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
        Schema::dropIfExists('aide_admins');
    }
};
