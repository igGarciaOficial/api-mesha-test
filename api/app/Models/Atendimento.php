<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Atendimento extends Model
{
    //
    public $timestamps = false;
    
    protected $fillable = [
        'initedOn',
        'finishedOn',
        'patient',
        'employeer',
    ];

    // Criando relacionamentos
    
    public function patient()
    {
        return $this->hasOne(User::class, 'patient', 'id');
    }

    public function employeer()
    {
        return $this->hasOne(User::class, 'employeer', 'id');
    }

    public function complaints()
    {
        return $this->belongsToMany(Queixas::class, 'relacionamento_queixas_atendimentos', 'attendance', 'complaint');
    }
}
