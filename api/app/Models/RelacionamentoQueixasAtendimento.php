<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelacionamentoQueixasAtendimento extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'attendance',
        'complaint',
    ];
}
