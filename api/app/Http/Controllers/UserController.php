<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;

class UserController extends Controller
{

    public function index()
    {
        return User::paginate(10);
    }

    public function store(Request $request)
    {
        try{

            User::create( $request->all() );
            return Response(['data' => 'Usuário criado com sucesso!'], 201);
            
        }catch(\Exception $e){
            if($e->errorInfo[0] == '23505'){
                return Respose(['ERROR' => 'Já há outro usuário com este email'], 500);
            }elseif($e->errorInfo[0] == '23502'){
                return Response(['ERROR' => 'Cretifique-se que todos os campos estão preenchidos'], 500);
            }
            return Response(['ERROR' => 'Error to create a new user' . explode(".", $e->getMessage())[0]], 500);
        }
    }
    
    public function show(Request $request, User $id)
    {
        return response()->json($id);
    }

    public function update(Request $request, $id)
    {
        $userTarget = User::findOrFail($id);
        $userTarget->update($request->all());
        
        return Response(['data'=>'Usuário atualizado com sucesso.'], 200);
    }

    public function destroy($id)
    {
        try {
            User::destroy($id);
            return Response(['data'=>'Usuário deletado com sucesso!'], 200);
        } catch (Exception $th) {
            return Response(['ERROR' => 'Error to delete user: ' . $th->getMessage()], 500);
        }
    }

    public function turnUserAEmployeer($requestId, $idTarget){
        try {
            $requestId = User::find($requestId);
            $idTarget = User::find($idTarget);

            if (!$requestId || !$idTarget)
                return Response(['ERROR' => 'Usuário solicitante ou usuário final não encontrado.'], 500);

            elseif ($requestId->type == 'employeer') {
                $idTarget->update(['type'=>'employeer']);

                return Response(['data' => "Usuário {$idTarget->name} é um funcionário agora."], 201);
            }else{
                return Response(['ERROR' => 'Usuário solicitante não tem permissão para esta ação.'], 403);
            }
        } catch (\Exception $th) {
            return Response(['ERROR' => 'Usuário solicitante ou usuário final não encontrado.'], 500);
        }

    }
}
