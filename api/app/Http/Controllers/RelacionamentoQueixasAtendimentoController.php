<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RelacionamentoQueixasAtendimento;

class RelacionamentoQueixasAtendimentoController extends Controller
{


    public static function createRelationship($idQueixa, $idAtendimento)
    {
        try {    
            RelacionamentoQueixasAtendimento::create([
                "attendance" => $idAtendimento,
                "complaint" => $idQueixa
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($idAtendimento)
    {
        return RelacionamentoQueixasAtendimento::where("attendance", $idAtendimento);
    }

}
