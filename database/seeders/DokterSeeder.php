<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dokter')->insert([
            [
                'nama' => 'Endra Agustino',
                'id_user' => 1,
                'alamat' => 'Jl. Poncowolo',
                'no_hp' => '081234567890',
                'id_poli' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bonjur',
                'id_user' => 2,
                'alamat' => 'Jl. Pamularsih',
                'no_hp' => '082345678901',
                'id_poli' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
