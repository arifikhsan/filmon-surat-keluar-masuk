<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositions', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->unsignedBigInteger('created_by_user_id');
            $table->unsignedBigInteger('addressed_to_user_id');
            $table->foreignId('letter_id')->constrained();
            $table->string('description');
            $table->timestamps();

            $table->foreign('created_by_user_id')->references('id')->on('users');
            $table->foreign('addressed_to_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispositions');
    }
}
