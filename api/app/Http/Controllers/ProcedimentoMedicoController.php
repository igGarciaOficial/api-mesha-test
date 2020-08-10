<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\ProcedimentoMedico;

class ProcedimentoMedicoController extends Controller
{

    public function index()
    {
        return ProcedimentoMedico::paginate(10);
    }

    public function store(Request $request)
    {
        try {
            ProcedimentoMedico::create($request->all());
            return Response(['data', 'Procedimento criado com sucesso!'], 201);
        } catch (\Exception $th) {
            return Response(['ERROR', 'Erro ao criar procedimento.'], 500);
        }
    }

    public function show($id)
    {
        return ProcedimentoMedico::find($id);
    }

    public function update(Request $request, $id)
    {
        try {
            $procedure = ProcedimentoMedico::find($id);
            $procedure->update($request->all());
            return Response(['data'=>'Procedimento atualizado com sucesso.'], 200);
            
        } catch (\Exception $th) {
            return Response(['ERROR' => 'Erro ao atualizar processo médico.'], 500);
        }
    }

    public function destroy($id)
    {
        //
    }
}
