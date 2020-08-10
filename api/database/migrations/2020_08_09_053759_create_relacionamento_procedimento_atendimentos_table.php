<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacionamentoProcedimentoAtendimentosTable extends Migration
{
    public function up()
    {
        Schema::create('relacionamento_procedimento_atendimentos', function (Blueprint $table) {
            $table->integer('attendance')->unsigned();
            $table->foreign('attendance')->references('id')->on('atendimentos');
            $table->integer('procedure')->unsigned();
            $table->foreign('procedure')->references('id')->on('procedimento_medicos');
            $table->primary(['attendance', 'procedure']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('relacionamento_procedimento_atendimentos');
    }
}
