<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacionamentoQueixasAtendimentosTable extends Migration
{

    public function up()
    {
        Schema::create('relacionamento_queixas_atendimentos', function (Blueprint $table) {
            $table->integer('attendance')->unsigned();
            $table->foreign('attendance')->references('id')->on('atendimentos');
            $table->integer('complaint')->unsigned();
            $table->foreign('complaint')->references('id')->on('queixas');
            $table->primary(['attendance', 'complaint']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('relacionamento_queixas_atendimentos');
    }
}
