<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\RelacionamentoProcedimentoAtendimento;

class RelacionamentoProcedimentoMedicosController extends Controller
{
    public static function createRelationshipWithAttendance($procedure, $idAtendimento)
    {
        try {
            RelacionamentoProcedimentoAtendimento::create([
                'attendance' => $idAtendimento,
                'procedure' => $procedure
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function showByAtendimento($idAtendimento)
    {
        return RelacionamentoProcedimentoAtendimento::where('attendance', $idAtendimento);
    }

    public function showByProcedure($idProcedure)
    {
        return RelacionamentoProcedimentoAtendimento::where('procedure', $idProcedure);
    }

    public static function getTotalTime($idAtendimento){
        $result = \DB::table('relacionamento_procedimento_atendimentos')
                ->where('attendance', $idAtendimento)
                ->join('procedimento_medicos', 'procedimento_medicos.id', '=', 'relacionamento_procedimento_atendimentos.procedure')
                ->sum('duration');

        return Response(['data'=>$result], 200);
    }
}
