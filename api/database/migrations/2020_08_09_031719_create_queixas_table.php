<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueixasTable extends Migration
{

    public function up()
    {
        Schema::create('queixas', function (Blueprint $table) {
            $table->id();
            $table->text('description')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('queixas');
    }
}
