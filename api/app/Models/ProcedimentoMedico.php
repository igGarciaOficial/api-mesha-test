<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcedimentoMedico extends Model
{
    //
    protected $fillable = [
        'name', 
        'description', 
        'price',
        'duration'
    ];
}
