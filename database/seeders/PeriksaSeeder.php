<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('periksa')->insert([
        [
            'id_daftar_poli' => 1,
            'tgl_periksa'    => '2025-06-01 09:00:00',
            'catatan'        => 'Pasien keluhan demam tinggi dan sakit kepala.',
            'biaya_periksa'  => 50000,
            'created_at'     => now(),
            'updated_at'     => now(),
        ],
        [
            'id_daftar_poli' => 2,
            'tgl_periksa'    => '2025-06-02 10:30:00',
            'catatan'        => 'Pasien mengalami batuk dan pilek.',
            'biaya_periksa'  => 40000,
            'created_at'     => now(),
            'updated_at'     => now(),
        ],
    ]);

    }
}
