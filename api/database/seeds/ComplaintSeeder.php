<?php

use Illuminate\Database\Seeder;
use App\Models\Queixas;
class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        Queixas::create([
        	'description' => 'Dor de estômago',
        ]);
    }
}
