<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;

class UserController extends Controller
{

    public function index(){
        return User::paginate(10);
    }

    public function store(Request $request){
        try{
            $request = json_decode($request->getContent());

            $user = User::create( [
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "born" => $request->born
            ]);
            return Response(['data' => 'Usuário criado com sucesso!', 'id' => $user->id], 201);
            
        }catch(\Exception $e){
            if($e->errorInfo[0] == '23505'){
                return Respose(['ERROR' => 'Já há outro usuário com este email'], 500);
            }elseif($e->errorInfo[0] == '23502'){
                return Response(['ERROR' => 'Cretifique-se que todos os campos estão preenchidos'], 500);
            }
            return Response(['ERROR' => 'Error to create a new user' . explode(".", $e->getMessage())[0]], 500);
        }
    }
    
    public function show(Request $request, User $id){
        return response()->json($id);
    }

    public function update(Request $request, $id){
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

    public function createEmployeer(Request $request){
        
        $requestId = User::find($request->requesterId);

        if (!$requestId)
            return Response(['ERROR' => 'Usuário solicitante não encontrado.'], 500);

        elseif ($requestId->type == 'employeer') {    
            try {
                User::create([
                    "name" => $request->name,
                    "email" => $request->email,
                    "born" => $request->born,
                    "phone" => $request->phone,
                    "type" => "employeer"
                ]);
                
                return Response(['data' => "Funcionário criado com sucesso."], 201);

            } catch (\Exception $th) {
                return Response(['ERROR' => "Erro ao criar usuário:{$th->getMessage()}"], 500);
            }
        
        }else{
            return Response(['ERROR' => 'Usuário solicitante não tem permissão para esta ação.'], 403);
        }

    }

    public function getUsersByType($type='patient'){
        $res = User::where('type', '=', $type)->paginate(10);
        return Response(['data' => $res->items()], 200);
    }

    public function receiveImageUploaded(Request $request, $id){
        
        try{
            $user = User::find($id);

            if($user){
                //Armazendo imagem na pasta 'avatars';
                $path = $request->file('avatar')->store('avatars');
                
                $user->update([
                    'avatar' => $path
                ]);
            }


        }catch(\Exception $e){
            return Response(['ERROR'=>'Usuário não encontrado'], 404);
        }
    }
}
