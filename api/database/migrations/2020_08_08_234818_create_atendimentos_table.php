<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtendimentosTable extends Migration
{
    public function up()
    {
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('initedOn');
            $table->datetime('finishedOn');
            $table->integer('patient')->unsigned();
            $table->foreign('patient')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('employeer')->unsigned();
            $table->foreign('employeer')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('atendimentos');
    }
}
