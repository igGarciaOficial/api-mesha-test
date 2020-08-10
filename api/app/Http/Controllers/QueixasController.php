<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queixas;

class QueixasController extends Controller
{

    public function index()
    {
        return Queixas::paginate(10);
    }

    public static function create($description)
    {
        try{
            Queixas::create(['description' => $description]);
        }catch(\Throwable $th){
            throw $th;
        }
    }

}
