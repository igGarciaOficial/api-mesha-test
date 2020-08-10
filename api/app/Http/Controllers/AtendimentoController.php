<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Atendimento;
use App\User;


class AtendimentoController extends Controller
{

    public function index()
    {
        return Atendimento::paginate(10);
    }

    public function store(Request $request)
    {
        $requesterUser = User::findOrFail($request->employeer);
        if(!$requesterUser)
            return Response(['Error'=>'Usuário solicitante não encontrado.'], 500);

        elseif($requesterUser->type == 'patient')
            return Response(['Error' => 'Operação negada para usuários do tipo paciente!', 403]);
        
        else {
            \DB::beginTransaction();
            
            try {
                $request = json_decode($request->getContent());

                $outerComplaints = $request->outherComplaints;
                
                $listaComplaints2 = array();

                foreach($outerComplaints as $comp){
                    $queixa = QueixasController::create($comp);
                    array_push($listaComplaints2, $queixa);
                }

                $atendimento = Atendimento::create([
                    "initedOn" => $request->inited,
                    "finishedOn" => $request->finished,
                    "patient" => $request->patient,
                    "employeer" => $request->employeer
                ]);

                $this->assignComplaints($request->complaints, $atendimento->id);
                $this->assignComplaints($listaComplaints2, $atendimento->id);
                $this->assignProcedures($request->procedures, $atendimento->id);

                \DB::commit();
                return Response(['data' => 'Atendimento criado com sucesso.', 'id' => $atendimento->id], 201);
                
            } catch (\Throwable $th) {
                \DB::rollback();
                return Response(['Error', 'Erro ao criar atendimento:'. $th->getMessage()], 500);
            }
        }

    }

    public function show($id)
    {
        return Atendimento::where('patient', $id)->paginate(10);
    }

    public function getAttendenceById($id)
    {
        $result = Atendimento:://where('id', $id)
                join('relacionamento_queixas_atendimentos', 'relacionamento_queixas_atendimentos.attendance', '=', 'atendimentos.id')
                
                ->join('relacionamento_procedimento_atendimentos', 'relacionamento_procedimento_atendimentos.attendance', '=', 'atendimentos.id')
                
                ->find($id);

        $duration = \DB::table('relacionamento_procedimento_atendimentos')
                ->where('attendance', $id)
                ->join('procedimento_medicos', 'procedimento_medicos.id', '=', 'relacionamento_procedimento_atendimentos.procedure')
                ->sum('duration');

        return Response(['data' => $result, 'proceduresTime' => $duration], 200);
    }

    public function destroy($id)
    {
        // Avaliar como seria o delete de atendimento
    }

    public function assignComplaints(Array $complaints, $idAtendimento)
    { 
        foreach ($complaints as $complaint) {
            try {
                RelacionamentoQueixasAtendimentoController::createRelationship($complaint->id, $idAtendimento);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    public function assignProcedures(Array $procedures, $idAtendimento)
    {
        foreach ($procedures as $proc) {
            try {
                RelacionamentoProcedimentoMedicosController::createRelationshipWithAttendance($proc->id, $idAtendimento);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }
}
