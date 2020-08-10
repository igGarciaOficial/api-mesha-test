<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelacionamentoProcedimentoAtendimento extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'attendance',
        'procedure'
    ];
}
