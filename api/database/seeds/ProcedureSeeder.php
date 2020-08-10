<?php

use Illuminate\Database\Seeder;
use App\Models\ProcedimentoMedico;

class ProcedureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('procedimento_medicos')->delete();

        ProcedimentoMedico::create([
        	'name' => 'Exame de sangue',
            'duration' => "00:30:00",
            'price' => "50"
        ]);
    }
}
