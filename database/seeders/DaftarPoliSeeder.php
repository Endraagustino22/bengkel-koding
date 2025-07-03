<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DaftarPoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('daftar_poli')->insert([
            [
                'id_pasien'    => 1, 
                'id_jadwal'    => 1, 
                'keluhan'      => 'Demam tinggi dan sakit kepala',
                'no_antrian'   => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'id_pasien'    => 2, 
                'id_jadwal'    => 1, 
                'keluhan'      => 'Batuk dan pilek',
                'no_antrian'   => 2,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ]
        ]);
    }
}
